<?php

class App_Controller_About extends App_Controller_Abstract
{


    public function run()
    {
        $V = new App_View_About();
        $V->prihlaseny = MFW_Session::get('auth', 'login');

        $this->setView($V);
    }
}