<?php

require "../handle.php";

require dirname(__DIR__) . '/../Cafe-Api/model/DataBase.php';

$database = new Database();

$uri=parse_url($_SERVER['REQUEST_URI'])['path'];
if($uri && $_SERVER['REQUEST_METHOD'] == 'POST'){
    $date=$_POST['date'];
    $status=$_POST['status'];
    $userId=$_POST['userId'];

$addOrder=$database->insertRow('orders',"insert into orders (userId,date,status) values 
(?,?,?)",[
$userId,
$date,
$status
]);
echo "Added order successfully.";
}else{
    echo "Error creating ";
}