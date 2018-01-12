<?php

Namespace Core;

Class Session extends Object_Abstract
{
    CONST HAS_NAMESPACE = FALSE;

    public function __construct()
    {
        $this->_prepareSession();
    }

    public function setData($key, $val)
    {
        $this::HAS_NAMESPACE
            ? $_SESSION[$this::NAMESPACE_ID][$key] = $val
            : $_SESSION[$key] = $val;

        return parent::setData($key, $val);
    }

    public function unsetData($key)
    {
        if ($this::HAS_NAMESPACE)
            unset($_SESSION[$this::NAMESPACE_ID][$key]);
        else
            unset($_SESSION[$key]);

        parent::unsetData($key);
    }

    protected function _prepareSession()
    {
        $session = $this::HAS_NAMESPACE
            ? $_SESSION[$this::NAMESPACE_ID]
            : $_SESSION;


        if ($session)
            foreach ($sesion as $k => $v)
                $this->setData($k, $v);
    }
}
