<?php

class MFW_Application {

    protected $_Controller;


    public function __construct(){

    }


    /**
     * Spusti aplikaciu
     */
    public function run() {

        try {

            $this->_runRouter();
            $this->_Controller->run();

        } catch (Exception $e) {
            $this->redirectToUri('err');
//            $ErrCtrl = new App_Controller_Error(new MFW_Request());
//            $ErrCtrl->run();
//            echo "Vynimka : " . $e->getMessage();
        }
    }


    /**
     * Podla URL dotazu zisti co treba zavolat
     */
    protected function _runRouter() {

        $Request = new MFW_Request();

        $controllerName = ucfirst(($Request->getGet('controller')) ? $Request->getGet('controller') : 'default');

        $controllerClass = 'App_Controller_' . $controllerName;

        $this->_Controller = new $controllerClass($Request);
    }

    protected function redirectToUri($uri)
    {

        $uri = MFW_Config::getConfig('main')->base_href . $uri;
        header('location: http://' . $uri);
    }

}
