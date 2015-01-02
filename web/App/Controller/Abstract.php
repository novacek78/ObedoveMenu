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
    }

    public function run()
    {
    }
}