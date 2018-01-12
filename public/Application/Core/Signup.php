<?php

Namespace Core;

Class Signup extends Object_Abstract
{
    CONST HAS_NAMESPACE = FALSE;

    public function __construct()
    {
        $this->_prepareSession();
    }

    public function createNewUser($key, $val)
    {
    	return 'aye lets get some money!';
    }
}
