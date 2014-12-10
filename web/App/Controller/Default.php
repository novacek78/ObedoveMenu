<?php

class App_Controller_Default extends MFW_Controller {


    public function run() {

        $V = new App_View_Default();

        $V->titulok = 'Obedové menu na Váš stôl.<br />Denne čerstvé.';

        $V->clanky = [
            [
                'nadpis' => 'Pre zákazníkov',
                'text'   => 'Ak Vás už omrzelo každý deň zisťovať, čo varia vo Vašej obľúbenej reštaurácii, ste na správnom mieste.
                Prihláste sa na zasielanie obedového menu z Vašej reštaurácie priamo na Váš e-mail, aby ste tak mali dennú ponuku vždy po ruke.
                Viac informácií nájdete tu &gt;'
            ],
            [
                'nadpis' => 'Pre reštaurácie',
                'text'   => 'Ak Vás už omrzelo každý deň vymýšľať obedové menu a potom ho písať vo Worde, zaregistrujte sa hneď teraz!
                Počas štartu projektu je to zatiaľ zdarma. Vytváranie denného / týždenného obedového menu nebolo nikdy jednoduchšie.
                Podrobnejšie informácie tu &gt;'
            ],
        ];

        $V->render();
    }

}