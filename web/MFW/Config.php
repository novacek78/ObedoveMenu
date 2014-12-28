<?php

/**
 * Created by PhpStorm.
 * User: enovacek
 * Date: 4. 12. 2014
 * Time: 14:03
 */
final class MFW_Config
{

    protected static $_instance = NULL;
    protected static $_data = NULL;


    private function __construct()
    {
        // PRIVATE - aby nikto iny nemohol ziskat jeho instanciu
    }

    /**
     * @return MFW_Config
     */
    public static function getConfig($cfgName)
    {

        if (self::$_instance == NULL) {
            self::$_instance = new MFW_Config();
        }

        self::$_instance->_loadConfigFile($cfgName);

        return self::$_instance;
    }

    private function _loadConfigFile($cfgName)
    {
        $fileName =
            $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR .
            $_SERVER['APP_PATH'] . DIRECTORY_SEPARATOR .
            'config' . DIRECTORY_SEPARATOR .
            $cfgName . '.php';

        $fileIncluded = include_once $fileName;

        if ($fileIncluded === 1) {
            if (is_array(self::$_data))
                self::$_data = array_merge(self::$_data, $C);
            else
                self::$_data = $C;
        }
    }

    public function __get($name)
    {

        return self::$_data[ $name ];
    }
}
