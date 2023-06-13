<?php
require('../../handle.php');



$database = new Database();

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

//isset($_GET["id"]?$_GET["id"]:die());
$id = parse_url($_SERVER['REQUEST_URI'])['query'];

// var_dump($id);

$url = explode('/', $uri)['5'];
if ("$url.'?'.$id" && $_SERVER['REQUEST_METHOD'] == 'GET') {
    $getOrderProduct = $database->getrow('', "SELECT o.date, o.status, SUM(p.price * op.quantity) AS order_price, p.name , p.price,  op.quantity
    FROM orders o
    JOIN order_product op ON o.orderID = op.order_id
    JOIN products p ON p.product_id = op.product_id
    WHERE o.userID = ?
    GROUP BY o.date, o.status, p.name, p.price, op.quantity; ", [$id]);
   $result =  $getOrderProduct->fetchALL(PDO::FETCH_ASSOC);
   echo json_encode(["data" => $result]);
   
} else {
    echo "No user with this id";
}
