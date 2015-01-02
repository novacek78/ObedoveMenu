<?php

class App_Controller_Logout extends App_Controller_Abstract
{


    public function run()
    {
        MFW_Session::clear('auth');
        MFW_Session::clearCookie('key');

        MFW_Utils::redirectToUri('/');
    }

}