<?php

class MFW_Utils
{


    public static function redirectToUri($uri = '')
    {
        if (isset($_SESSION))
            session_write_close();

        $uri = MFW_Config::getConfig('main')->base_href . $uri;
        header('location: http://' . $uri);
        exit;
    }


}