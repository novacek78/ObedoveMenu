<?php

/**
 * Created by PhpStorm.
 * User: enovacek
 * Date: 2. 12. 2014
 * Time: 15:29
 */
class App_View_Err extends App_View_Abstract
{

    public function render()
    {

        $this->injectLayout('default_header', 'header_content');
        $this->injectLayout('err', 'main_content');
        $this->injectLayout('default_footer', 'footer_content');

        echo $this->_html;
    }
}
