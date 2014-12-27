<?php

/**
 * Created by PhpStorm.
 * User: enovacek
 * Date: 2. 12. 2014
 * Time: 15:20
 */
class MFW_View
{

    protected $_contentData = array();
    protected $_resources = array();
    protected $_html = '';


    /**
     * Spusti rendrovanie obsahu
     */
    public function render()
    {

    }

    public function __get($name)
    {

        return $this->_contentData[ $name ];
    }

    public function __set($name, $value)
    {

        $this->_contentData[ $name ] = $value;
    }

    public function addResources($filename)
    {

        $ext = substr($filename, strrpos($filename, '.') + 1);

        $this->_resources[ $ext ][] = MFW_Config::getConfig('main')->resources_dir . $filename;
    }

    public function getResources($type)
    {

        if (isset($this->_resources[ $type ]))
            return $this->_resources[ $type ];
        else
            return array();
    }

    public function appendLayout($name)
    {

        $this->_html .= $this->getLayoutCompiledCode($name);
    }

    /**
     * Inkluduje a aj vykona kod v PHP subore layoutu
     *
     * @param string $name
     * @return string Vystup PHP kodu zo suboru layoutu
     */
    protected function getLayoutCompiledCode($name)
    {
        $filePath = explode('_', $name);
        $fileName = $filePath[ count($filePath) - 1 ];

        unset($filePath[ count($filePath) - 1 ]);
        $filePath = array_map('ucfirst', $filePath);

        $path = implode(DIRECTORY_SEPARATOR, $filePath) . DIRECTORY_SEPARATOR . $fileName . '.php';
        if (count($filePath) > 0) $path = DIRECTORY_SEPARATOR . $path;

        $fullPath = $_SERVER['APP_PATH'] . DIRECTORY_SEPARATOR . 'Layout' . $path;

        if (file_exists($fullPath)) {
            ob_start();
            $V = $this;
            include $fullPath;
            return ob_get_clean();
        }
    }

    /**
     * Na miesto PLACEHOLDER textu vlozi skript (HTML kod) zo suboru NAME
     *
     * @param string $name
     * @param string $placeholder
     */
    public function injectLayout($name, $placeholder)
    {
        if ($this->_html == '') throw new Exception('No HTML code yet. Can\'t insert layout.');

        $layoutCode = $this->getLayoutCompiledCode($name);
        $layoutCode = "\n<!-- $placeholder -->\n" . $layoutCode . "\n<!-- END OF $placeholder -->"; // pre prehladnost vysledneho HTML kodu

        $this->_html = str_replace('<!-- @' . $placeholder . '@ -->', $layoutCode, $this->_html);
    }

//    public function compile()
//    {
//
//        // nahradi vsetky vyskyty #nieco# za $this->nieco
//        $this->_html = preg_replace_callback('#(\#)[a-z]+(\#)#',
//            function ($matches) {
//                $najdene = str_replace('#', '', $matches[0]);
//                if (is_array($this->$najdene))
//                    return implode('<br>', $this->$najdene);
//                else
//                    return $this->$najdene;
//            }, $this->_html);
//
//    }

    /**
     * @param array  $pole
     * @param string $htmlMarkup
     * @param bool   $associativeArray
     * @return string
     */
    private function arrayToHtml($pole, $htmlMarkup, $associativeArray = true)
    {
        if (!is_array($pole)) exit;

        $result = '';
        foreach ($pole as $item) {

            if ($associativeArray) {

                $i = 0;
                if (!is_array($item)) throw new Exception('Array supplied is only 1D');
                foreach ($item as $key => $val) {
                    $patterns[ $i ] = '/#' . $key . '#/';
                    $i++;
                }
            } else {

                if (is_array($item)) {
                    for ($i = 0; $i < count($item); $i++) {
                        $patterns[ $i ] = '/#' . $i . '#/';
                    }
                } else
                    $patterns = '/#0#/';
            }

            $result .= preg_replace($patterns, $item, $htmlMarkup) . "\n";
        }

        return $result;
    }
}