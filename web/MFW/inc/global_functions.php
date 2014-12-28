<?php


spl_autoload_register('loadClass');
register_shutdown_function('exitScript');


/**
 * Autoloader
 *
 * @param string $className
 */
function loadClass($className)
{

    if (!class_exists($className)) {

        $dirs = explode('_', $className);
        $file = $dirs[ count($dirs)-1 ] . '.php';
        unset($dirs[ count($dirs)-1 ]);

        $path = implode(DIRECTORY_SEPARATOR, $dirs);
        $file = $path . DIRECTORY_SEPARATOR . $file;

        if (file_exists($file)) {
            include_once $file;
        } else {
            if (strpos($file, 'Controller')) {
                throw new Exception('Unknown controller: ' . $file, EC_CONTROLLER_NOT_EXISTS);
            } else {
                lg('Unknown class file: ' . $file, LL_FATAL, array('with_request_details' => 1));
                throw new Exception('Unknown class file: ' . $file, EC_FILE_NOT_FOUND);
            }
        }
    }
}

function exitScript()
{
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
        lg('Fatal error handler: ' . "ErrNo:$errno , ErrFile:$errfile , ErrLine:$errline , ErrStr:$errstr", LL_ERROR);

        //TODO dorobit logovanie / mailovanie chyby
    }
}


/**
 * Logovanie do textoveho suboru
 *
 * @param string $msg
 * @param int    $level
 */
function lg($msg, $level = LL_DEBUG, $options = 0)
{
    $f = fopen(
        $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR .
        $_SERVER['APP_PATH'] . DIRECTORY_SEPARATOR .
        'logs' . DIRECTORY_SEPARATOR .
        'log.txt', 'a');

    if (!$f) {
        return false;
    }

    switch ($level) {
        case LL_DEBUG:
            $sLevel = 'DBG';
            break;
        case LL_EXCEPTION:
            $sLevel = 'EXC';
            break;
        case LL_ERROR:
            $sLevel = 'ERR';
            break;
        case LL_WARNING:
            $sLevel = 'WRN';
            break;
        case LL_INFO:
            $sLevel = 'INF';
            break;
        case LL_CRITICAL:
            $sLevel = 'CRT';
            break;
        case LL_FATAL:
            $sLevel = 'FAT';
            break;
        case LL_NOTICE:
            $sLevel = 'NTC';
            break;
        default:
            $sLevel = 'N/A';
    }

    if (($options & LO_WITH_URI_SEGMENTS) || ($options & LO_ALL_REQUEST_DATA)) {
        $msg .= "\nURI: " . var_export($_REQUEST, true);
    }

    if (($options & LO_WITH_GET_DATA) || ($options & LO_ALL_REQUEST_DATA)) {
        $msg .= "\nGET: " . var_export((isset($_GET) ? $_GET : NULL), true);
    }

    if (($options & LO_WITH_POST_DATA) || ($options & LO_ALL_REQUEST_DATA)) {
        $msg .= "\nPOST: " . var_export($_POST, true);
    }

    $dateTime = date('d.m.Y H:i:s');
    $msg = "$dateTime ($sLevel) $msg\n";
    fwrite($f, $msg);

    fclose($f);
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