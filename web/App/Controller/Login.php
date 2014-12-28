<?php

class App_Controller_Login extends MFW_Controller
{


    public function run()
    {
        $this->_View = new App_View_Login();
        $this->_View->addResources('css/login.css');
    }

}