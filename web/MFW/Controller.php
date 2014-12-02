<?php
/**
 * Created by PhpStorm.
 * User: enovacek
 * Date: 1. 12. 2014
 * Time: 22:58
 */

class MFW_Controller {

    protected $_Request;
    protected $_View;


    /**
     * @param MFW_Request $Request
     */
    public function __construct($Request){

        $this->_Request = $Request;
    }

    /**
     * Spusti beh controllera
     */
    public function run()
    {

    }
}