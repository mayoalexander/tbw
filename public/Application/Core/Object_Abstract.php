<?php
/*
 * Object abstract class
 */

Namespace Core;

class Object_Abstract
{

    /**
     * @var array
     */
    protected $_data = array();

    /**
     * Object_Abstract constructor.
     * @param $data
     */
    public function __construct(array $data = [])
    {
        $this->_data = $data;
    }

    /*
     * Set data on object
     *
     * @param string $key
     * @param mixed $val
     * @return Object_Abstract
     */
    public function setData($key, $val)
    {
        $this->_data[$key] = $val;

        return $this;
    }

    /*
     * Add array of data to object
     *
     * @param array $data
     * @return Object_Abstract
     */
    public function addData(array $data)
    {
        foreach ($data as $key => $d)
            $this->setData($key, $d);

        return $this;
    }

    public function unsetData($key)
    {
        if (isset($this->_data[$key]))
            unset($this->_data[$key]);

        return $this;
    }

    /**
     * Get data or all data from object.
     *
     * @param string $key
     * @param null $default
     * @return array|mixed|null
     */
    public function getData($key = '', $default = null)
    {
        if (!$key) return $this->_data;

        return isset($this->_data[$key])
            ? $this->_data[$key]
            : $default;
    }

    /**
     * Get an attribute as an object property.
     *
     * @param string $key
     * @return array|mixed|null
     */
    public function __get($key)
    {
        return $this->getData($key);
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function __set($key, $value)
    {
        $this->setData($key, $value);
    }

    /**
     * @return array|mixed|null
     */
    public function toArray()
    {
        return $this->_data;
    }

    /**
     * @return string
     */
    public function toString()
    {
        return json_encode($this->toArray());
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->toString();
    }
}
