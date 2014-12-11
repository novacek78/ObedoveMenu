<?php

class App_Controller_Err extends MFW_Controller
{  // class sa nesmie volat 'error' lebo to potom nefunguje netusim preco


    public function run()
    {
        $V = new App_View_Err();

        $V->titulok = 'Nastala chybicka';
        $V->clanok = 'Stala sa nejaka chyba, prosim kontaktujte nas na adrese: ' . MFW_Config::getConfig('email')->from_email;

        $V->render();
    }

}