<?php

/**
 * Created by PhpStorm.
 * User: enovacek
 * Date: 2. 12. 2014
 * Time: 15:41
 */
class MFW_Layout
{

    protected $_name;
    protected $_contents;
    protected $_cssFiles = array();
    protected $_jsFiles = array();


    public function __construct($Data)
    {

        $this->_contents = $Data;
    }

    public function compile()
    {

    }
} 