<?php

require "../handle.php";

require dirname(__DIR__) . '/../Cafe-Api/model/DataBase.php';

$database = new Database();
// var_dump($database);

$uri=parse_url($_SERVER['REQUEST_URI'])['path'];

if($uri && $_SERVER['REQUEST_METHOD'] == 'GET') { 
    $getAllorders=$database->getrows('orders',"SELECT * FROM orders");
    echo "$getAllorders";
}else{
    echo "failed to get all orders";
}