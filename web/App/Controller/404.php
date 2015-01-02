<?php

class App_Controller_404 extends App_Controller_Abstract
{  // class sa nesmie volat 'error' lebo to potom nefunguje netusim preco


    public function run()
    {
        $V = new App_View_Err();

        $V->titulok = 'Stránka nenájdená';
        $V->clanok = 'Žiaľ stránka, ktorú žiadate sa tu nenachádza. Prosím skontrolujte správnosť zadania URL adresy.';

        $this->setView($V);
    }

}