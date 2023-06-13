<?php

require('../../handle.php');



$database = new Database();

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$id = parse_url($_SERVER['REQUEST_URI'])['query'];
// var_dump($id);

if ("$uri.'?'.$id " && $_SERVER['REQUEST_METHOD'] == 'DELETE') {
  $deleteOrder = $database->deleteRow('order', "delete FROM orders where orderID=? ", [$id]);
  echo "deleted successfully";
} else {
  echo "invaild id";
}
