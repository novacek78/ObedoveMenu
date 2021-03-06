<?php

class App_Controller_Login extends App_Controller_Abstract
{


    public function run()
    {
        // prihlaseny user uz nemoze vidiet prihlasovaci formular
        if ($this->userLogin != NULL)
            MFW_Utils::redirectToUri(); //FIXME redirect by mal byt niekam do casti pre prihlasenych

        // prihlasime usera
        if ($this->_isPost()) {

            $postData = $this->_getPostData();

            $User = new App_Model_User();
            $loginResult = $User->doLogin($postData['login_name'], $postData['password'], NULL, NULL, isset($postData['remember_login']));

            if ($loginResult) {
                MFW_Session::clearCookie('vid'); // ak sa prihlasil, zrusime ho ako navstevnika, lebo uz je to user
                MFW_Utils::redirectToUri(); //FIXME redirect by mal byt niekam do casti pre prihlasenych
            } else {
                //TODO set user error message
                MFW_Session::addUserMessage('Prihlásenie neúspešné.', UM_ERROR);
                MFW_Utils::redirectToUri('login');
            }

        } else {

            $V = new App_View_Login();
            $V->addResources('css/login.css');

            $this->setView($V);
        }

    }

}