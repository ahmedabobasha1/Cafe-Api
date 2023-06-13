<?php

require "../handle.php";

require dirname(__DIR__) . '/../Cafe-Api/model/DataBase.php';

$database = new Database();

$uri=parse_url($_SERVER['REQUEST_URI'])['path'];

//isset($_GET["id"]?$_GET["id"]:die());
$id=parse_url($_SERVER['REQUEST_URI'])['query'];

// var_dump($id);

$url=explode('/', $uri )['5'];
if("$url.'?'.$id"&& $_SERVER['REQUEST_METHOD'] == 'GET'){
    $getOrder=$database->getrow('',"select * FROM orders where orderID=? ",[$id]);
    echo "$getOrder";
}else{
    echo "invaild id";
}