<?php

class App_Controller_Default extends MFW_Controller {


    public function run() {

        $V = new App_View_Default();

        $V->titulok = 'Vitajte na nasej stranke!';
        $V->clanok = 'Toto je prvy pokus s mojim vlastnym MVC modelom frameworku, preto by ste sa nemali cudovat, ak tu nieco nebude sediet. ;)';
        $V->ludia = [
            ['meno' => 'jano', 'vek' => 22],
            ['meno' => 'duro', 'vek' => 11]
        ];

        $V->render();
    }

}