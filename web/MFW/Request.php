<?php
/**
 * Created by PhpStorm.
 * User: enovacek
 * Date: 1. 12. 2014
 * Time: 21:53
 */

class MFW_Request {

    protected $_getData = NULL;
    protected $_postData = null;


    public function __construct(){

        if (!empty($_GET)) {
            $this->_getData = $_GET;
            unset($_GET);
        }

        if (!empty($_POST)) {
            $this->_postData = $_POST;
            unset($_POST);
        }
    }


    public function getGet($index){

        if (isset($this->_getData[ $index ]))
            return $this->_getData[ $index ];
        else
            return false;
    }


    public function getPost($name){

        if (isset($this->_postData[$name]))
            return $this->_postData[$name];
        else
            return false;
    }
}