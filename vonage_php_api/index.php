<?php
require "vendor/autoload.php";
require "config.php";

$vonage = new \Vonage\Vonage('GeekSale01', 'Cp;6XZ@c@8');
$params = array(
    'start' => '2016-10-19T22:26:36+02:00'
);
//var_dump( $vonage->getCookie() );
//var_dump($vonage->test);
echo "<pre>";
var_dump($vonage->request('callhistory/438', $params)); die();
echo "</pre>";
die();