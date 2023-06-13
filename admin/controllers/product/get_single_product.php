<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Headers 

header('Access-Control-Allow-Origin');
header('Content-Type: application/json');
header('Access-Control-Allow-Mehods:GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Access-Control-Allow-Headers, Authorization, X-Requested-With');

require('/var/www/html/cafe_project/model/DataBase.php');

$imageDir = "/cafe_project/admin/controllers/product/uploaded_img/";

$db = new Database();
if($_SERVER["REQUEST_METHOD"]=== 'GET'){


$data=json_decode(file_get_contents("php://input"),TRUE); 

$product_id=$_GET['id'];

$result = $db->getrow('products','select * from products where product_id = ?',[$product_id]);

   $rowNum = $result->rowCount();
if($rowNum > 0){
    $result =  $result->fetch(PDO::FETCH_ASSOC);
    $product_arr = [
        'p_id'=>$result['product_id'],
        'p_name'=>$result['name'],
        'p_quantity'=>$result['quantity'],
        'p_price'=>$result['price'],
        'p_description'=>$result['description'],
        'p_image'=>isset($_SERVER['HTTPS'])?'https':'http'.'://'.$_SERVER['HTTP_HOST'].$imageDir.$result['image']
    ];
      echo json_encode($product_arr);
}
}
echo json_encode([
    'error'=>"wrong http method"
   ]);  
?>

