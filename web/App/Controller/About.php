<?php

class App_Controller_About extends MFW_Controller
{


    public function run()
    {
        $this->_View = new App_View_About();
    }
}