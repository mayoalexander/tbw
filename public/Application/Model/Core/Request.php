<?php

Namespace Model\Core;

class Request extends \Core\Object_Abstract
{
    public function __construct()
    {   
        foreach ($_REQUEST as $key => $val)
            $this->setData($key, $val);
    }   

    /*  
     * Backwards compat with current app
     * Noticed certain times data is set on the request superglobal
     *
     * @return \Model\Core\Request
     */
    public function setData($key, $val)
    {   
        parent::setData($key, $val);

        $_REQUEST[$key] = $val;

        return $this;
    }   
}
