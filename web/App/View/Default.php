<?php

/**
 * Created by PhpStorm.
 * User: enovacek
 * Date: 2. 12. 2014
 * Time: 15:29
 */
class App_View_Default extends MFW_View
{

    public function render()
    {

        echo '<html><title>' . MFW_Config::getConfig('main')->title . '</title>';
        echo '<h1>' . $this->titulok . '</h1>';
        echo '<p>' . $this->clanok . '</p>';
    }
}