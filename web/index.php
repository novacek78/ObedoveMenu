<?php

include_once 'MFW/inc/global_constants.php';
include_once 'MFW/inc/global_functions.php';

if (isset($_SERVER['APP_PATH'])) {
    set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT'] . $_SERVER['APP_PATH']);
}

if (isset($_SERVER['FW_PATH'])) {
    set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT'] . $_SERVER['FW_PATH']);
}

$Application = new MFW_Application();
$Application->run();
