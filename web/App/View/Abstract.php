<?php

abstract class App_View_Abstract extends MFW_View
{

    /**
     * Spolocny konstruktor.
     * Sluzi pre nalinkovanie vsetkych JS, CSS, ... suborov, ktore sa pouzivaju v KAZDOM pohlade
     */
    public function __construct()
    {
        $this->addResources('css/base_frame.css');
        $this->addResources('css/header.css');
        $this->addResources('css/content.css');
        $this->addResources('css/footer.css');
        $this->addResources('css/responsiveness.css');

        $this->insertLayout('skeleton');
    }

}
