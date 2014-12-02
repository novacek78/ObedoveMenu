<?php

class MFW_Application {

    protected $_Controller;
    protected $_environment;


    public function __construct(){

        $this->_environment = $_SERVER['APPLICATION_ENV'];
    }


    /**
     * Spusti aplikaciu
     */
    public function run() {

        try {

            $this->_runRouter();
            $this->_Controller->run();

        } catch (Exception $e) {
            echo "Vynimka : " . $e->getMessage();
        }
    }


    /**
     * Podla URL dotazu zisti co treba zavolat
     */
    protected function _runRouter() {

        $Request = new MFW_Request();

        $controllerName = ucfirst( ($Request->getGet(1)) ? $Request->getGet(1) : 'default' );

        $controllerClass = CONTROLLER_PREFIX . $controllerName;
        $this->_Controller = new $controllerClass($Request);
    }

}
