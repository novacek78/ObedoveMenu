<?php

$C = array();
$e = $_SERVER['APPLICATION_ENV'];


// default hodnoty
$C['base_href'] = 'www.spapajma.sk/';


if ($e == 'DEVELOPMENT') {

    $C['base_href'] = 'sluzbyludom.bt/';

} elseif ($e == 'TESTING') {

} elseif ($e == 'PRODUCTION') {

}


$C['resources_dir'] = 'http://' . $C['base_href'] . 'public/';
