<?php

/**
 * Created by PhpStorm.
 * User: enovacek
 * Date: 2. 12. 2014
 * Time: 15:29
 */
class App_View_Err extends App_View_Abstract
{

    public function __construct()
    {
        parent::__construct();

        $this->insertLayout('default_header', 'header_content');
        $this->insertLayout('err', 'main_content');
        $this->insertLayout('default_footer', 'footer_content');
    }
}
