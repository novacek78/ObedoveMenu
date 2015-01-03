<?php

abstract class MFW_Model_User extends MFW_Model_Abstract
{

    public function __construct()
    {
        $this->_DAO = new MFW_Model_UserDao();
    }

    public function doLogin($login, $pwd, $uid = NULL, $key = NULL, $rememberLogin = false)
    {
        $result = false;

        if ((!empty($login) && !empty($pwd)) || (!empty($uid) && !empty($key))) {

            // overenie prihlasovacich dat
            $resultAuth = $this->_DAO->authenticate($login, $pwd, $uid, $key);

            // ulozenie prihlasenia do session / cookie
            if ($resultAuth) {

                $resultAuth['remember_login'] = $rememberLogin;
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

            MFW_Session::setCookie('uid', $data['uid']);

            if (isset($data['remember_login'])) {
                MFW_Session::setCookie('key', $data['key']);
            }
        }
    }

}