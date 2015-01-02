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
    protected $_contentData = array();
    /**
     * @var MFW_View
     */
    private $_View;

    /**
     * @param MFW_Request $Request
     */
    public function __construct($Request)
    {
        $this->_Request = $Request;
    }

    /**
     * Spusti beh controllera
     */
    abstract public function run();

    public function __get($name)
    {
        if (isset($this->_contentData[ $name ]))
            return $this->_contentData[ $name ];
        else
            return NULL;
    }

    public function __set($name, $value)
    {
        $this->_contentData[ $name ] = $value;
    }


    /**
     * Priradi controlleru pohlad
     * + ak uz boli do controllera nasetovane nejake dynamicke data, prilepi ich do daneho pohladu
     *
     * @param MFW_View $view
     */
    public function setView(MFW_View $view)
    {
        $this->_View = $view;
        $this->_View->mergeContentData($this->_contentData);
    }

    /**
     * Zobrazi pohlad priradeny controlleru
     */
    public function renderView()
    {
        if (isset($this->_View))
            $this->_View->echoHtml();
        else {
            lg('This controller has no view assigned.', LL_EXCEPTION);
            MFW_Utils::redirectToUri('about');
        }
    }

    /**
     * Zisti, ci je request po odoslani formulara
     *
     * @return bool
     */
    protected function _isPost()
    {
        return $this->_Request->isPost;
    }

    protected function _getPostData()
    {
        return $this->_Request->getPostData();
    }
}