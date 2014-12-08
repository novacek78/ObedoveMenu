<?php

/**
 * Created by PhpStorm.
 * User: enovacek
 * Date: 2. 12. 2014
 * Time: 15:20
 */
class MFW_View
{

    protected $_contents = array();
    protected $_html = '';


    /**
     * Spusti rendrovanie obsahu
     */
    public function render()
    {

    }

    public function __get($name)
    {

        return $this->_contents[ $name ];
    }

    public function __set($name, $value)
    {

        $this->_contents[ $name ] = $value;
    }

    public function loadLayout($name)
    {

        $filePath = explode('_', $name);
        $fileName = $filePath[ count($filePath) - 1 ];
        unset($filePath[ count($filePath) - 1 ]);
        $filePath = array_map('ucfirst', $filePath);

        $path = implode(DIRECTORY_SEPARATOR, $filePath) . DIRECTORY_SEPARATOR . $fileName . '.php';
        if (count($filePath) > 0) $path = DIRECTORY_SEPARATOR . $path;

        $full = $_SERVER['APP_PATH'] . DIRECTORY_SEPARATOR . 'Layout' . $path;

        if (file_exists($full)) {
            ob_start();
            $V = $this;
            include $full;
            $this->_html .= ob_get_clean();
        }
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
    private function arrayToHtml($pole, $htmlMarkup, $associativeArray = false)
    {
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