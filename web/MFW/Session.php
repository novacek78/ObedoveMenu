<?php

final class MFW_Session
{


    public static function set($namespace, $name, $value)
    {
        $_SESSION[ $namespace ][ $name ] = $value;
    }

    public static function setCookie($name, $value, $lifetimeDays = 120)
    {
        $expire = time() + 3600 * 24 * $lifetimeDays;
        setcookie($name, $value, $expire, '/', NULL, NULL, true);
    }

    public static function getCookie($name)
    {
        if (isset($_COOKIE[ $name ]))
            return $_COOKIE[ $name ];
        else
            return NULL;
    }

    public static function clearCookie($name)
    {
        $expire = time() - 3600 * 24;
        setcookie($name, NULL, $expire, '/');
    }

    public static function addUserMessage($text, $type = UM_INFO)
    {
        self::add('user', 'messages', ['text' => $text, 'type' => $type]);
    }

    public static function add($namespace, $arrayName, $value)
    {
        $_SESSION[ $namespace ][ $arrayName ][] = $value;
    }

    public static function getUserMessages($autoClear = true)
    {
        $ret = self::get('user', 'messages');

        if ($autoClear)
            self::clear('user', 'messages');

        return $ret;
    }

    public static function get($namespace, $name)
    {
        if (isset($_SESSION[ $namespace ][ $name ]))
            return $_SESSION[ $namespace ][ $name ];
        else
            return NULL;
    }

    public static function clear($namespace, $name = NULL)
    {
        if ($name == NULL)
            unset($_SESSION[ $namespace ]);
        else
            unset($_SESSION[ $namespace ][ $name ]);
    }

}