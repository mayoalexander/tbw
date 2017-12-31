<?php
date_default_timezone_set('America/Los_Angeles');

final class Application {

    // Static variable to hold all singleton models
    static private $_models     = array();
    // Static variable to hold all registry entries
    static private $_registry   = array();

    public static function getSingleton($singletonName)
    {
        if (!isset(self::$_models[$singletonName]))
            self::$_models[$singletonName] = self::getModel($singletonName);

        return self::$_models[$singletonName];
    }

    public static function getModel($modelName)
    {
        $modelName  = empty($modelName) ? 'Model_Abstract' : $modelName;
        $model      = '\Model\\' . $modelName;

        return new $model;
    }
}
