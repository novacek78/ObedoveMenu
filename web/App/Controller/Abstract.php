<?php

abstract class App_Controller_Abstract extends MFW_Controller
{

    /**
     * Vsetky inicializacne veci alebo veci spustane v kazdom pohlade / controlleri
     */
    public function __construct($Request)
    {
        parent::__construct($Request);

        $this->prihlasenyLogin = MFW_Session::get('auth', 'login');
        $this->prihlasenyId = MFW_Session::get('auth', 'uid');

        if ($this->prihlasenyId == NULL) {
            // ak nie je aktualne prihlaseny v systeme (nie je v session, skusime ci ma v COOKIEs ulozene user ID
            $uid = MFW_Session::getCookie('uid');
            $key = MFW_Session::getCookie('key');

            if (!empty($uid) && !empty($key)) {
                // ak sa v COOKIE nasli vsetky prihlasovacie udaje, prihlasime ho
                $User = new App_Model_User();
                $User->doLogin(NULL, NULL, $uid, $key);
            } elseif (!empty($uid)) {
                // ak sa v COOKIE naslo len UID, znamena to, ze tu uz bol ale automaticky sa prihlasovat nechce

            } else {
                // ak sa v COOKIE nenaslo nic, znamena to, ze je to novy clovek (alebo ma zakazane cookies)

            }
        }
    }

    public function run()
    {
    }
}