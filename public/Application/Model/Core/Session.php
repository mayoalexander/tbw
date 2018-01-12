<?php

Namespace Model\Core;

class Session extends \Core\Object_Abstract
{
    public function __construct()
    {
        foreach ($_SESSION as $key => $val)
            $this->setData($key, $val);
    }

    public function setData($key, $val)
    {
        parent::setData($key, $val);

        $_SERVER[$key] = $val;

        return $this;
    }
}
