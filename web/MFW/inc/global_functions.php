<?php


spl_autoload_register('loadClass');
register_shutdown_function( 'fatalHandler' );



function loadClass($className, $once = true){

    if (!class_exists($className)) {

        $dirs = explode('_', $className);
        $file = $dirs[ count($dirs)-1 ] . '.php';
        unset($dirs[ count($dirs)-1 ]);

        $path = implode(DIRECTORY_SEPARATOR, $dirs);
        $file = $path . DIRECTORY_SEPARATOR . $file;

        if (file_exists($file)) {
            if ($once)
                include_once $file;
            else
                include $file;
        }
    }
}

function fatalHandler() {
    $errfile = "unknown file";
    $errstr  = "shutdown";
    $errno   = E_CORE_ERROR;
    $errline = 0;

    $error = error_get_last();

    if( $error !== NULL) {
        $errno   = $error["type"];
        $errfile = $error["file"];
        $errline = $error["line"];
        $errstr  = $error["message"];

        //TODO dorobit logovanie / mailovanie chyby
    }
}


function lg($msg)
{
//    $filePath =
}

/**
 * Vypise VAR_DUMP prijatych dat
 *
 * @param      $data
 * @param bool $bHtmlspecialchars
 */
function vd($data, $description = '', $bHtmlspecialchars = true)
{

    echo '<div style="clear:both;">&nbsp;</div><pre style="font-size:14px;line-height: 1.5em;color:#000000;background: #ccffcc;padding:5px;border:1px solid #75a075;padding: 15px;">';
    $aDebug = debug_backtrace( );
    $sDebugKey = false;

    foreach ($aDebug as $k => $v) {
        if (is_array($v) && $v['function']) {
            if (strpos($v['function'], 'vd') !== false) {
                $sDebugKey = $k;
            }
        }
    }

    echo '<p>' . $aDebug[$sDebugKey]['file'] . ':' . $aDebug[$sDebugKey]['line'] . '</p>';

    if ($description != '')
        echo "<p><b>$description :</b></p>";

    if (is_string($data) && $bHtmlspecialchars) {
        $data = htmlspecialchars($data);
    }

    if (strlen(serialize($data)) > 20480) {
        if (is_object($data)) {
            $data = get_class($data);
        } else {
            $data = null;
        }

        print '<h1>Data too big:' . $data . '</h1>';
    } else {
        var_dump($data);
    }

    echo '</pre>';
}


/**
 * Vypise VAR_DUMP prijatych dat a ukonci beh skriptu
 *
 * @param      $data
 * @param bool $bHtmlspecialchars
 */
function vde($data, $description = '', $bHtmlspecialchars = true)
{

    vd($data, $description, $bHtmlspecialchars);
    exit;
}