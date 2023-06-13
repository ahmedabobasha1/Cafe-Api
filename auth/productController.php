<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


// require(dirname(__DIR__) . '/model/DataBase.php');

require('../model/DataBase.php');


$db = new Database();




$result =  $db->getrows('orders', 'select * from orders');

echo  json_encode(["data" => $result]);
