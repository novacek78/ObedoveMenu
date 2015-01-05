<?php

class App_Controller_Err extends App_Controller_Abstract
{  // class sa nesmie volat 'error' lebo to potom nefunguje netusim preco


    public function run()
    {
        //TODO odmailovat adminovi, ze o tomto case sa stala chyba

        $V = new App_View_Err();

        $V->titulok = 'Nastala chybička';
        $V->clanok = 'Ak neviete, prečo sa to stalo, kontaktujte nás prosím na adrese: ' . MFW_Config::getConfig('email')->from_email;

        $this->setView($V);
    }

}