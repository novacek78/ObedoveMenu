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

        session_start();

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
                MFW_Session::addUserMessage('Stránka nenájdená', UM_ERROR);
                MFW_Utils::redirectToUri('404');
                    break;

                default:
                    MFW_Utils::redirectToUri('err');
                    break;
            }
        }
    }


    /**
     * Podla URL dotazu zisti co treba zavolat
     */
    protected function _runRouter() {

        $Request = new MFW_Request();

        $controllerName = ucfirst(($Request->getGetParam('controller')) ? $Request->getGetParam('controller') : 'about');

        $controllerClass = 'App_Controller_' . $controllerName;

        $this->_Controller = new $controllerClass($Request);
    }

}
