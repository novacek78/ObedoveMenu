<?php

class MFW_Application {

    /**
     * @var MFW_Controller
     */
    protected $_Controller;



    public function __construct(){

    }

    /**
     * Spusti aplikaciu
     */
    public function run() {

        lg('----- start -----', LL_INFO);
        try {

            $this->_runRouter();
            $this->_Controller->run();
            $this->_Controller->renderView();

        } catch (Exception $e) {
            lg($e->getMessage(), LL_EXCEPTION, LO_ALL_REQUEST_DATA);

            switch ($e->getCode()) {
                case EC_BAD_ROUTE:
                case EC_CONTROLLER_NOT_EXISTS:
                case EC_METHOD_NOT_EXISTS:
                case EC_FILE_NOT_FOUND:
                    $this->redirectToUri('404');
                    break;

                default:
                    $this->redirectToUri('err');
                    break;
            }
        }
    }


    /**
     * Podla URL dotazu zisti co treba zavolat
     */
    protected function _runRouter() {

        $Request = new MFW_Request();

        $controllerName = ucfirst(($Request->getGet('controller')) ? $Request->getGet('controller') : 'about');

        $controllerClass = 'App_Controller_' . $controllerName;

        $this->_Controller = new $controllerClass($Request);
    }

    protected function redirectToUri($uri)
    {

        $uri = MFW_Config::getConfig('main')->base_href . $uri;
        header('location: http://' . $uri);
        exit;
    }

}
