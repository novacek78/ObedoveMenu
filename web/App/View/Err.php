<?php

/**
 * Created by PhpStorm.
 * User: enovacek
 * Date: 2. 12. 2014
 * Time: 15:29
 */
class App_View_Err extends MFW_View
{

    public function render()
    {

        $this->loadLayout('default_header');
        $this->loadLayout('err');
        $this->loadLayout('default_footer');

        echo $this->_html;
    }
}
