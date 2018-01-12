<?php

namespace Core;

class Conn extends \Core\Object_Abstract
{

    protected $_pdo;

    /*  
     * Construct function
     * Set up single connection to database. Route requests through this class
     */
    public function __construct()
    {   

        $dbname = 'thebaewatch_october';
        $dbhost = 'localhost';
        $dbuser = 'amayo';
        $dbpass = 'Simplicity93!';
        $dbport = 3306;

        $_pdo = new \PDO("mysql:host=$dbhost;port=$dbport;dbname=$dbname;charset=utf8", $dbuser, $dbpass);
        $_pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        $this->_pdo = $_pdo;
    }   

    /*  
     * Get PDO object for database functions
     *
     * @return \PDO
     */
    public function getPDO()
    {   
        return $this->_pdo;
    }   
}
