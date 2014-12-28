<?php

class App_Controller_Err extends MFW_Controller
{  // class sa nesmie volat 'error' lebo to potom nefunguje netusim preco


    public function run()
    {
        //TODO odmailovat adminovi, ze o tomto case sa stala chyba

        $this->_View = new App_View_Err();

        $this->_View->titulok = 'Nastala chybička';
        $this->_View->clanok = 'Vyskytla sa chyba, prosím kontaktujte nás na adrese: ' . MFW_Config::getConfig('email')->from_email;
    }

}