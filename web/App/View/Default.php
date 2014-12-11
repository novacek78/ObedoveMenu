<?php

/**
 * Created by PhpStorm.
 * User: enovacek
 * Date: 2. 12. 2014
 * Time: 15:29
 */
class App_View_Default extends App_View_Abstract
{

    public function render()
    {
        $this->insertLayout('default_header', 'header_content');
        $this->insertLayout('default_content', 'main_content');

        echo $this->_html;
    }
}
