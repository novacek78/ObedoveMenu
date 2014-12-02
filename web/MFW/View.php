<?php

/**
 * Created by PhpStorm.
 * User: enovacek
 * Date: 2. 12. 2014
 * Time: 15:20
 */
class MFW_View
{

    protected $_contents = array();
    protected $_Layout;


    /**
     * Spusti rendrovanie obsahu
     */
    public function render()
    {

    }

    public function __get($name)
    {

        return $this->_contents[ $name ];
    }

    public function __set($name, $value)
    {

        $this->_contents[ $name ] = $value;
    }
} 