<?php

require('../../handle.php');

header('Access-Control-Allow-Mehods:DELETE');


$db = new Database();

$imageDir = "./uploaded_img/";

$data = json_decode(file_get_contents("php://input"), TRUE);

$product_id = $data['id'];
// var_dump($product_id);
$product = $db->getRow('products', 'select * from products where product_id =?', [$product_id]);

$row = $product->fetchAll(PDO::FETCH_ASSOC);
$image_path = $imageDir . $row[0]['image'];
if (file_exists($image_path)) {
    unlink($image_path);
}
$delete_row = $db->deleteRow('products', 'delete from products where product_id =?', [$product_id]);

if ($delete_row) {

    echo json_encode([
        'message' => "deleted successful"
    ]);
}
