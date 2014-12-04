<?php

$C = array();
$e = $_SERVER['APPLICATION_ENV'];


// default hodnoty
$C['title'] = 'Dobry den!';


if ($e == 'DEVELOPMENT') {

    $C['title'] = 'bleeeeeee :)))';

} elseif ($e == 'TESTING') {

} elseif ($e == 'PRODUCTION') {

}
