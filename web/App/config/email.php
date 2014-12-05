<?php

$C = array();
$e = $_SERVER['APPLICATION_ENV'];


// default hodnoty
$C['from_name'] = 'SpapajMa.sk';
$C['from_email'] = 'info@spapajma.sk';
$C['smtp_host'] = '';
$C['smtp_username'] = '';
$C['smtp_password'] = '';


if ($e == 'DEVELOPMENT') {

} elseif ($e == 'TESTING') {

} elseif ($e == 'PRODUCTION') {

}
