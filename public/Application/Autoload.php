<?php

/*
 * Set up autoloader function 
 * Load new classes using namespaces
 */ 

 include_once('vendor/autoload.php');


spl_autoload_register(function($class) {
    $include    = str_replace(array('\\','/'), DS, __DIR__ . DS . $class . '.php');
    //$asset      = str_replace(array('\\','/'), DS, __DIR__ . DS . '..' . DS . 'assets' . DS . $class . '.php');

    $fallback =  [
        $include,
        // $asset
    ];

    foreach ($fallback as $path) {
        if (false === ($path = realpath($path))) {
            continue;
        } else {
            require_once($path);
            return true;
        }   
    }   

    return false;
});
