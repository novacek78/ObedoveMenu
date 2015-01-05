<?php

abstract class App_Controller_Abstract extends MFW_Controller
{

    /**
     * Vsetky inicializacne veci alebo veci spustane v kazdom pohlade / controlleri
     */
    public function __construct($Request)
    {
        parent::__construct($Request);

        $this->userLogin = MFW_Session::get('auth', 'login');
        $this->userId = MFW_Session::get('auth', 'uid');

        if ($this->userId == NULL) {
            // ak nie je aktualne prihlaseny v systeme (nie je v session), skusime ci ma v COOKIEs ulozene user ID
            $vid = MFW_Session::getCookie('vid');
            $uid = MFW_Session::getCookie('uid');
            $key = MFW_Session::getCookie('key');

            if (!empty($uid) && !empty($key)) {
                // ak sa v COOKIE nasli vsetky prihlasovacie udaje, prihlasime ho
                $User = new App_Model_User();
                $User->doLogin(NULL, NULL, $uid, $key);

                $this->userLogin = MFW_Session::get('auth', 'login');
                $this->userId = MFW_Session::get('auth', 'uid');
            } elseif (!empty($uid)) {
                // ak sa v COOKIE naslo len UID, znamena to, ze tu uz bol ale automaticky sa prihlasovat nechce

            } elseif (!empty($vid)) {
                // ak ma nastavene VID (visitor id) tak tu uz bol ale nie je registrovany
                $this->visitorId = $vid;
            } else {
                // ak sa v COOKIE nenaslo nic, znamena to, ze je to novy clovek (alebo ma zakazane cookies)
                $User = new App_Model_User();
                $visitorId = $User->doCreateVisitor();
                MFW_Session::setCookie('vid', $visitorId); // nastavime mu to hned z prichodu ako VID (visitor id)
            }
        }

        $this->_viewProperties['userMsg'] = MFW_Session::getUserMessages();
    }

    public function run()
    {
    }

}