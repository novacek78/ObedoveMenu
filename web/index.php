<?php

include_once 'MFW/inc/global_constants.php';
include_once 'MFW/inc/global_functions.php';


if (isset($_SERVER['APP_PATH'])) {
    set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT'] . $_SERVER['APP_PATH']);
}

if (isset($_SERVER['FW_PATH'])) {
    set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT'] . $_SERVER['FW_PATH']);
}

//vde($_SERVER);
//vd($_SERVER['APPLICATION_ENV']);
//vd( $_GET );
//vde( $_SERVER['REQUEST_URI'] );
//vd(get_include_path());


$Application = new MFW_Application();
$Application->run();
