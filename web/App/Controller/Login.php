<?php

class App_Controller_Login extends App_Controller_Abstract
{


    public function run()
    {
        // prihlaseny user uz nemoze vidiet prihlasovaci formular
        if ($this->prihlasenyLogin != NULL)
            MFW_Utils::redirectToUri('about'); //FIXME redirect by mal byt niekam do casti pre prihlasenych

        // prihlasime usera
        if ($this->_isPost()) {

            $postData = $this->_getPostData();

            $User = new App_Model_User();
            $loginResult = $User->doLogin($postData['login_name'], $postData['password']);

            if ($loginResult) {
                MFW_Utils::redirectToUri('about'); //FIXME redirect by mal byt niekam do casti pre prihlasenych
            } else {
                //TODO set user error message
                MFW_Utils::redirectToUri('about');
            }

        } else {

            $V = new App_View_Login();
            $V->addResources('css/login.css');

            $this->setView($V);
        }

    }

}