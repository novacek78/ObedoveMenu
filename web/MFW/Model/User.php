<?php

abstract class MFW_Model_User extends MFW_Model_Abstract
{

    public function __construct()
    {
        $this->_DAO = new MFW_Model_UserDao();
    }

    public function doLogin($login, $pwd)
    {
        $result = false;

        if (!empty($login) && !empty($pwd)) {

            // overenie prihlasovacich dat
            $resultAuth = $this->_DAO->authenticate($login, $pwd);

            // ulozenie prihlasenia do session / cookie
            if ($resultAuth) {

                $resultAuth['login'] = $login; // lebo este aj toto potrebujeme poznat v _saveSessionData()
                $this->_saveSessionData($resultAuth);
                $result = true;
            }
        } else {
            //TODO chybova hlaska ze daco chyba
        }

        return $result;
    }

    protected function _saveSessionData($data)
    {
        if (is_array($data)) {

            MFW_Session::set('auth', 'login', $data['login']);
            MFW_Session::set('auth', 'uid', $data['uid']);

            if (isset($postData['remember_login'])) {
                MFW_Session::setCookie('uid', $data['uid']);
                MFW_Session::setCookie('key', $data['key']);
            }
        }
    }

}