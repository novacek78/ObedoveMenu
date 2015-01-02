<?php

class App_Controller_Err extends App_Controller_Abstract
{  // class sa nesmie volat 'error' lebo to potom nefunguje netusim preco


    public function run()
    {
        //TODO odmailovat adminovi, ze o tomto case sa stala chyba

        $V = new App_View_Err();

        $V->titulok = 'Nastala chybička';
        $V->clanok = 'Vyskytla sa chyba, prosím kontaktujte nás na adrese: ' . MFW_Config::getConfig('email')->from_email;

        $this->setView($V);
    }

}