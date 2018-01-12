<?php
Namespace Model;

class Model_Abstract extends \Core\Object_Abstract 
{
    /*
     * Initialize this model by getting the column names of this models table
     * Call in child model construct to self initialize the model
     *
     * @return \Model\Model_Abstract
     */

    /**
     * Initialize function for a model with a database table behind it
     * Loads valid keys for model data
     *
     * @return \Model\Model_Abstract
     */
    public function init()
    {
        // If keys is defined, a model of this same type has already been loaded. No need to get the column names again
        if (!$this::$_keys) {
            $tableName = $this->getTableName();
            // \Model\Core\Conn
            $query = \Application::getConn()->getPDO()->query(
                "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME=N'$tableName';"
            );

            $keys = $query->fetchAll(\PDO::FETCH_ASSOC);

            // Not entirely sure why the previous query picks up these columns sometimes
            // Remove them as they will cause an issue
            $remove = array(
                'USER',
                'CURRENT_CONNECTIONS',
                'TOTAL_CONNECTIONS'
            );

            foreach ($keys as $k => $v) {
                if (!in_array($v['COLUMN_NAME'], $remove))
                    $this::$_keys[$v['COLUMN_NAME']] = $v['COLUMN_NAME'];
            }
        }

        foreach ($this::$_keys as $key)
            $this->setData($key, NULL);

        return $this;
    }

    /*
     * Get this models table name
     *
     * @return string
     */
    public function getTableName()
    {
        return $this::TABLE;
    }

    /*
     * Save current model to the database
     * 
     * @return \Model\Model_Abstract
     */
    public function save()
    {
        $this->_beforeSave();

        $update     = array();
        $updateCols = array();

        // Only save data that is assigned to columns that exist
        // Discard erroneous data
        foreach ($this::$_keys as $key) {
            $_d = $this->getData($key);
            if (isset($_d))
                $update[$key] = $_d;
        }

        if (!count($update)) return;

        // Unset the PRIKEY column if it is an autoincrement
        foreach (array_keys($update) as $key) {
            if ($this::AUTOINC && $key == $this::PRIKEY) continue;

            $updateCols[] = '`' . $key . '`' . " = VALUES(`$key`)";
        }

        // Generate on duplicate update string
        $onDup = implode(', ', $updateCols);


        // Generate values string of ? for PDO bound parameters
        $places = '(' . implode(', ', array_fill(0, count(array_keys($update)), '?')) . ')';

        // Generate sql query
        $sql = '
        INSERT INTO `' . $this->getTableName() . '` (`' . implode('`, `', array_keys($update)) .
        '`) VALUES ' . $places . ' ON DUPLICATE KEY UPDATE ' . $onDup;


        // \Model\Core\Conn
        $pdo        = \Application::getConn()->getPDO();
        $statement  = $pdo->prepare($sql);

        // Execute pdo query with update values in array
        $statement->execute(array_values($update));

        if ($this::AUTOINC && $pdo->lastInsertId())
            $this->setData($this::PRIKEY, $pdo->lastInsertId());

        $this->_afterSave();

        return $this;
    }

    /*
     * Function called after save function completed
     */
    protected function _afterSave()
    {
        // Entry point for encrypting fields should there be a need
    }

    protected function _beforeSave()
    {
    }

    /*
     * Function called after load function completed
     */
    protected function _afterLoad()
    {
        return $this;
    }

    /*
     * Model Load function
     * Loads by primary key
     *
     * @param string | int $val
     *
     * @return instance of \Model\Model_Abstract
     */
    public function load($val)
    {
        // \Model\Core\Conn
        $conn   = \Application::getConn();
        $query  = 'SELECT * FROM `' . $this::TABLE . '` WHERE ' . $this::PRIKEY . '=' . $val . ' LIMIT 1;';
        try {
            $query  = $conn->getPDO()->query($query);
            $data   = $query->fetchAll(\PDO::FETCH_ASSOC);

            if (!$data)
                return false;

            $this->addData($data[0]);

            $this->_afterLoad();

            return $this;
        } catch (\PDOException $e) {
            $this->setData('_lastError', $e);
            return false;
        }
    }


    public function loadByAttributes($data)
    {
        $conn   = \Application::getConn();
        $table  = $this::TABLE;

        $query  = "
        SELECT *
        FROM `{$table}`
        ";

        $first = 0;

        foreach ($data as $column => $val) {
            if (!isset($this::$_keys[$column]))
                return false;

            if (!$first) {
                $first++;

                $query .="
                WHERE `{$column}` = ?
                ";
            } else {
                $query .= "
                AND `{$column}` = ?
                ";
            }
        }

        $query .= "
        LIMIT 1
        ";

        $query = $conn->getPDO()->prepare($query);

        $query->execute(array_values($data));

        $results = $query->fetch(\PDO::FETCH_ASSOC);

        if (!$results)
            return false;

        $this->addData($results);

        $this->_afterLoad();

        return $this;
    }

    /*
     * Load Model by column
     *
     * @param string $column | Column name
     * @param mixed $val
     * @return bool | instance of \Model\Model_Abstract
     */
    public function loadByAttribute($column, $val)
    {
        // Do not continue if the column name requested is not a column on the table
        if (!isset($this::$_keys[$column])) return false;

        // \Model\Core\Conn
        $conn   = \Application::getConn();
        $table  = $this::TABLE;
        $query  = $conn->getPDO()->prepare("
        SELECT * FROM `$table` WHERE $column=:val LIMIT 1;
        ");

        $query->bindParam(':val', $val, \PDO::PARAM_STR);
        $query->execute();

        $data = $query->fetch(\PDO::FETCH_ASSOC);

        if (!$data)
            return false;

        $this->addData($data);

        $this->_afterLoad();

        return $this;
    }

    public function delete()
    {
        if (!$this::AUTOINC)
            throw new \Exception('Can only delete an autoinc table entry with this function');

        // Write in eav? Actually, should be handled by foreign key associations
        if ($this->getDeletedColumn()) {
            $this->setData($this->getDeletedColumn(), 1)->save();
        } else {
            $sql = "
                DELETE FROM `" . $this::TABLE . "`
                WHERE `" . $this::PRIKEY . "` = :key
            ";

            $conn = \Application::getConn();
            $query = $conn->getPDO()->prepare($sql);

            $query->bindParam(':key', $this->getData($this::PRIKEY));
            $query->execute();
        }

        return true;
    }


    protected function getDeletedColumn()
    {
        return $this::DELETED;
    }

}
