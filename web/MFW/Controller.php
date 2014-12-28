<?php
/**
 * Created by PhpStorm.
 * User: enovacek
 * Date: 1. 12. 2014
 * Time: 22:58
 */
abstract class MFW_Controller
{

    /**
     * @var MFW_Request
     */
    protected $_Request;

    /**
     * @var MFW_View
     */
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
    abstract public function run();

    /**
     * Zobrazi pohlad priradeny controlleru
     */
    public function renderView()
    {
        $this->_View->echoHtml();
    }
}