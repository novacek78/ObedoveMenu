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

        include_once $_SERVER['APP_PATH'] . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'main.php';
        self::$_data = $C;
    }

    /**
     * @return MFW_Config
     */
    public static function getConfig()
    {

        if (self::$_instance == NULL) {
            self::$_instance = new MFW_Config();
        }

        return self::$_instance;
    }

    public function __get($name)
    {

        return self::$_data[ $name ];
    }
}
