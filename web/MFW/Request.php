<?php
/**
 * Created by PhpStorm.
 * User: enovacek
 * Date: 1. 12. 2014
 * Time: 21:53
 */

class MFW_Request {

    protected $_getParams = null;
    protected $_postData = null;


    public function __construct(){

        if (!empty($_GET)) {
            $this->_getParams = $_GET;
            unset($_GET);
        }

        if (!empty($_POST)) {
            $this->_postData = $_POST;
            unset($_POST);
        }
    }


    public function getGet($index){

        $index = 'p'.$index;
        if (isset($this->_getParams[$index]))
            return $this->_getParams[$index];
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