<?php

/**
 * Created by PhpStorm.
 * User: enovacek
 * Date: 2. 12. 2014
 * Time: 15:20
 */
abstract class MFW_View
{
    protected $_layout = '';
    protected $_contentData = array();
    protected $_resources = array();
    private $_html = '';



    public function __get($name)
    {
        if (($name == 'css') || ($name == 'js')) {
            return $this->getResources($name);
        } elseif (isset($this->_contentData[ $name ]))
            return $this->_contentData[ $name ];
        else
            return NULL;
    }

    public function __set($name, $value)
    {
        $this->_contentData[ $name ] = $value;
    }

    public function getResources($type)
    {
        if (isset($this->_resources[ $type ]))
            return $this->_resources[ $type ];
        else
            return array();
    }

    public function addResources($filename)
    {
        $ext = substr($filename, strrpos($filename, '.') + 1);

        $this->_resources[ $ext ][] = MFW_Config::getConfig('main')->resources_dir . $filename;
    }

    /**
     * Vypise na vystup cely konecny HTML kod pohladu aj s vlozenymi datami.
     *
     * @return bool
     */
    public function echoHtml()
    {
        if ($this->_html == '') $this->_html = $this->_compile($this->_layout);

        echo $this->_html;

        return true;
    }

    /**
     * 'Skompiluje' layout pohladu - resp.nahradi vsetky placeholdery v layoute zodpovedajucimi datami
     * a vysledny HTML kod ulozi do protected premennej _html
     *
     * @return bool
     */
    protected function _compile($html)
    {
        $lastSharpPos = 0;

        while ($sharpPos = strpos($html, '#', $lastSharpPos)) {

            // ak sa nasla klauzula na rendrovanie pola (#array:premenna# .... #endarray#)
            if (substr($html, $sharpPos + 1, 5) == 'array') {

                $blockHeaderStart = $sharpPos;
                $blockHeaderEnd = strpos($html, '#', $blockHeaderStart + 1);

                $identifier = substr($html, $blockHeaderStart + 7, $blockHeaderEnd - $blockHeaderStart - 7);

                $blockFooterStart = strpos($html, '#endarray:' . $identifier . '#', $sharpPos + 1);

                $arrayItemCode = substr($html, $blockHeaderEnd + 1, $blockFooterStart - $blockHeaderEnd - 1);

                $arrayItems = '';
                if (is_array($this->$identifier)) {

                    foreach ($this->$identifier as $item) {

                        $arrayItems .= preg_replace_callback('#(\#\w+\#)#',
                                function ($matches) use ($item) {
                                    $najdene = str_replace('#', '', $matches[0]);
                                    if (is_array($item))
                                        return $item[ $najdene ];
                                    else
                                        return $item;
                                }, $arrayItemCode) . "\n";
                    }
                }

                $html = substr_replace($html, $arrayItems, $blockHeaderStart, strlen('#begin:' . $identifier . '#' . $arrayItemCode . '#endarray:' . $identifier . '#'));

                // ak sa nasla klauzula pre vlozenie hodnoty z konfiguracneho suboru (#config:nazov#)
            } elseif (substr($html, $sharpPos + 1, 6) == 'config') {

                $endSharpPos = strpos($html, '#', $sharpPos + 1);
                $placeholder = substr($html, $sharpPos + 8, $endSharpPos - $sharpPos - 8);

                list($cfgName, $valName) = explode(':', $placeholder);

                $value = MFW_Config::getConfig($cfgName)->$valName;
                $html = substr_replace($html, $value, $sharpPos, $endSharpPos - $sharpPos + 1);

                // ak sa nasla klauzula pre podmieneny vypis bloku (#if:premenna# ... #else# ... #endif#)
            } elseif (substr($html, $sharpPos + 1, 2) == 'if') {

                $endSharpPos = strpos($html, '#', $sharpPos + 1);
                $variable = substr($html, $sharpPos + 4, $endSharpPos - $sharpPos - 4);
                $endIfSharpPos = strpos($html, '#endif:' . $variable . '#', $sharpPos + 1);
                $headerLength = 5 + strlen($variable);
                $ifBlock = substr($html, $sharpPos + $headerLength, $endIfSharpPos - $sharpPos - $headerLength);
                list($trueBlock, $falseBlock) = explode('#else#', $ifBlock);

                $varValue = (isset($this->_contentData[ $variable ]) ? $this->$variable : NULL); // isset() ale aj !empty() na $this->$variable by stale hadzala FALSE
                $vysledok = '';
                if (!empty($varValue)) {
                    if ((!is_bool($varValue)) || ((is_bool($varValue)) && ($varValue === true))) {
                        $vysledok = $this->_compile($trueBlock);
                    }
                } elseif (!empty($falseBlock)) {
                    $vysledok = $this->_compile($falseBlock);
                }
                $html = substr_replace($html, $vysledok, $sharpPos, $headerLength + strlen($ifBlock . '#endif:' . $variable . '#'));

            } else {
                $endSharpPos = strpos($html, '#', $sharpPos + 1);
                $identifier = substr($html, $sharpPos + 1, $endSharpPos - $sharpPos - 1);
                $html = substr_replace($html, $this->$identifier, $sharpPos, $endSharpPos - $sharpPos + 1);
            }

            $lastSharpPos = $sharpPos + 1;
        }

        return $html;
    }

    /**
     * Vlozi do pohladu layout
     * Ak nie je zadefinovany PLACEHOLDER, tak ho prilepi na koniec existujuceho layoutu,
     * ale ak je zadefinovany, tak v existujucom layoute vyhlada PLACEHOLDER a namiesto neho vlozi novy layout.
     *
     * @param string $name Meno layoutu - napr. 'default_footer' alebo 'header'
     * @param string $placeholder Znacka v existujucom layoute, ktora bude vyhladana a tam vlozeny layout
     */
    public function insertLayout($name, $placeholder = NULL)
    {
        if ($placeholder == NULL)
            $this->_layout .= $this->_getLayoutCode($name);
        else {
            $layoutPlaceholder = '<!-- @' . $placeholder . '@ -->';
            $layoutCode = "\n<!-- $placeholder -->\n" . $this->_getLayoutCode($name) . "\n<!-- END OF $placeholder -->"; // pre prehladnost vysledneho HTML kodu
            $this->_layout = str_replace($layoutPlaceholder, $layoutCode, $this->_layout);
        }
    }

    /**
     * Nacita zo suboru HTML kod layoutu
     *
     * @param $name
     * @return bool|string HTML kod layoutu
     */
    protected function _getLayoutCode($name)
    {
        $pathSegments = explode('_', $name);
        $fileName = $pathSegments[ count($pathSegments) - 1 ];

        unset($pathSegments[ count($pathSegments) - 1 ]);
//        $pathSegments = array_map('ucfirst', $pathSegments);

        $filePath = implode(DIRECTORY_SEPARATOR, $pathSegments) . DIRECTORY_SEPARATOR . $fileName . '.html';
        if (count($pathSegments) > 0) $filePath = DIRECTORY_SEPARATOR . $filePath;

        $fullFilePath = $_SERVER['APP_PATH'] . DIRECTORY_SEPARATOR . 'layout' . $filePath;

        if (file_exists($fullFilePath)) {
            return trim(file_get_contents($fullFilePath), " \t\n\r\0\x0B\xEF\xBB\xBF");
        } else
            return false;
    }


    /**
     * Inkluduje a aj vykona kod v PHP subore layoutu
     *
     * @param string $name
     * @return string Vystup PHP kodu zo suboru layoutu
     */
//    protected function getLayoutCompiledCode($name)
//    {
//        $filePath = explode('_', $name);
//        $fileName = $filePath[ count($filePath) - 1 ];
//
//        unset($filePath[ count($filePath) - 1 ]);
//        $filePath = array_map('ucfirst', $filePath);
//
//        $path = implode(DIRECTORY_SEPARATOR, $filePath) . DIRECTORY_SEPARATOR . $fileName . '.php';
//        if (count($filePath) > 0) $path = DIRECTORY_SEPARATOR . $path;
//
//        $fullPath = $_SERVER['APP_PATH'] . DIRECTORY_SEPARATOR . 'layout' . $path;
//
//        if (file_exists($fullPath)) {
//            ob_start();
//            $V = $this;
//            include $fullPath;
//            return ob_get_clean();
//        }
//    }



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
//    private function arrayToHtml($pole, $htmlMarkup, $associativeArray = true)
//    {
//        if (!is_array($pole)) exit;
//
//        $result = '';
//        foreach ($pole as $item) {
//
//            if ($associativeArray) {
//
//                $i = 0;
//                if (!is_array($item)) throw new Exception('Array supplied is only 1D');
//                foreach ($item as $key => $val) {
//                    $patterns[ $i ] = '/#' . $key . '#/';
//                    $i++;
//                }
//            } else {
//
//                if (is_array($item)) {
//                    for ($i = 0; $i < count($item); $i++) {
//                        $patterns[ $i ] = '/#' . $i . '#/';
//                    }
//                } else
//                    $patterns = '/#0#/';
//            }
//
//            $result .= preg_replace($patterns, $item, $htmlMarkup) . "\n";
//        }
//
//        return $result;
//    }
}