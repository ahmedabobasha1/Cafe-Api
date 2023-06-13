<?php

require('../../handle.php');



$database = new Database();
// var_dump($database);

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

if ($uri && $_SERVER['REQUEST_METHOD'] == 'GET') {
    $stmt = $database->getrows('orders', "SELECT * FROM orders");

    $getAllorders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(["data" => $getAllorders]);
} else {
    echo "failed to get all orders";
}
