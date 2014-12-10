<?php

/**
 * Created by PhpStorm.
 * User: enovacek
 * Date: 2. 12. 2014
 * Time: 15:29
 */
class App_View_Abstract extends MFW_View
{

    /**
     * Konstruktor pre nalinkovanie vsetkych JS, CSS, ... suborov, ktore sa pouzivaju v KAZDOM pohlade
     */
    public function __construct()
    {
        $this->addResources('css/base_frame.css');
        $this->addResources('css/header.css');
        $this->addResources('css/content.css');
        $this->addResources('css/footer.css');
    }
}
