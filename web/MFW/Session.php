<?php

final class MFW_Session
{


    public static function set($namespace, $name, $value)
    {
        $_SESSION[ $namespace ][ $name ] = $value;
    }

    public static function clear($namespace, $name = NULL)
    {
        if ($name == NULL)
            unset($_SESSION[ $namespace ]);
        else
            unset($_SESSION[ $namespace ][ $name ]);
    }

    public static function get($namespace, $name)
    {
        if (isset($_SESSION[ $namespace ][ $name ]))
            return $_SESSION[ $namespace ][ $name ];
        else
            return NULL;
    }

    public static function setCookie($name, $value, $lifetimeDays = 120)
    {
        $expire = time() + 3600 * 24 * $lifetimeDays;
        setcookie($name, $value, $expire, '/', NULL, NULL, true);
    }

    public static function clearCookie($name)
    {
        $expire = time() - 3600 * 24;
        setcookie($name, NULL, $expire, '/');
    }


}