<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Headers 

header('Access-Control-Allow-Origin');
header('Content-Type: application/json');
header('Access-Control-Allow-Mehods:DELETE');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Access-Control-Allow-Headers, Authorization, X-Requested-With');

require('/var/www/html/cafe_project/model/DataBase.php');

$db = new Database();

if( $_SERVER["REQUEST_METHOD"] === 'DELETE'){

$imageDir = "./uploaded_img/";


$product_id = $_GET['id'];

$product = $db->getRow('products','select * from products where product_id =?',[$product_id]);
     
$row = $product->fetchAll(PDO::FETCH_ASSOC);
$image_path = $imageDir.$row[0]['image'];
if(file_exists($image_path)){
    unlink($image_path);
}
 $delete_row = $db->deleteRow('products','delete from products where product_id =?',[$product_id]);

 if($delete_row){

echo json_encode([
    'message'=>"deleted successful"
   ]);  
 }

}else{
    echo json_encode([
    'error'=>"wrong http method"
   ]);  
}
