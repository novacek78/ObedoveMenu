<?php

class App_Controller_404 extends MFW_Controller
{  // class sa nesmie volat 'error' lebo to potom nefunguje netusim preco


    public function run()
    {
        $this->_View = new App_View_Err();

        $this->_View->titulok = 'Stránka nenájdená';
        $this->_View->clanok = 'Žiaľ stránka, ktorú žiadate sa tu nenachádza. Prosím skontrolujte správnosť zadania URL adresy.';
    }

}