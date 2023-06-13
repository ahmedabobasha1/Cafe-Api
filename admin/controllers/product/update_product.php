<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Headers 

header('Access-Control-Allow-Origin');
header('Content-Type: application/json');
header('Access-Control-Allow-Mehods:POST');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Access-Control-Allow-Headers, Authorization, X-Requested-With');

require('/var/www/html/cafe_project/model/DataBase.php');

$db = new Database();
$p_image = $_FILES['image']['name'];
$extention = explode(".",$p_image);
$extention = strtolower((end($extention)));

$image_name = "product_".time().'.'.$extention;

$p_image_folder = "./uploaded_img/".$image_name;



$categories = $_POST['categories']??[]; // it's array


$update_row = $db->updateRow('products', 'UPDATE products SET     
name = ?,
price = ?,
image = ?,
description = ? ,
quantity =?
where product_id = ?
', [$_POST['name'], $_POST['price'],$image_name, $_POST['description'], $_POST['quantity'], $_POST['product_id']]);

// $rows_affected = $update_row->rowCount();

move_uploaded_file($_FILES['image']['tmp_name'],$p_image_folder);

if (!empty($categories)) {
    $db->deleteRow('category_product', 'delete from category_product where product_id =?', [$_POST['product_id']]);

    foreach ($categories as $category)
        $db->insertRow('category_product', "insert into category_product (product_id,category_id)
            values(?,?)", [$_POST['product_id'], $category]);
}

echo json_encode([
    'message' => "updated successful"
]); 

