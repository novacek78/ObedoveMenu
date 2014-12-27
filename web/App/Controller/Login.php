<?php

class App_Controller_Login extends MFW_Controller
{


    public function run()
    {

        $V = new App_View_Login();
        $V->addResources('css/login.css');

        $V->titulok = 'Prihlásenie';

        $V->render();
    }

}