<?php

$C = array();
$e = $_SERVER['APPLICATION_ENV'];


// default hodnoty
$C['db_host'] = '';
$C['db_username'] = '';
$C['db_password'] = '';


if ($e == 'DEVELOPMENT') {

} elseif ($e == 'TESTING') {

} elseif ($e == 'PRODUCTION') {

}
