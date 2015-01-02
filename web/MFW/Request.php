<?php
/**
 * Created by PhpStorm.
 * User: enovacek
 * Date: 1. 12. 2014
 * Time: 21:53
 */

class MFW_Request {

    public $isPost;
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

        $this->isPost = ($_SERVER['REQUEST_METHOD'] === 'POST');
    }


    public function getGetData()
    {

        if (isset($this->_getData))
            return $this->_getData;
        else
            return NULL;
    }


    public function getPostData()
    {

        if (isset($this->_postData))
            return $this->_postData;
        else
            return NULL;
    }

    public function getGetParam($name)
    {

        if (isset($this->_getData[ $name ]))
            return $this->_getData[ $name ];
        else
            return NULL;
    }


    public function getPostParam($name)
    {

        if (isset($this->_postData[$name]))
            return $this->_postData[$name];
        else
            return NULL;
    }
}