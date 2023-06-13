<?php

require('../../handle.php');



$database = new Database();

 $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
 if ($uri && $_SERVER['REQUEST_METHOD'] == 'POST') {
   

    $data=json_decode(file_get_contents("php://input"),TRUE); 

  
    $date = $data['date'];
    $status = $data['status'];
    $userID = $data['userID'];
    $products=$data['products'];

 
        if (!((isset($status)) && !empty($status))) {
        echo json_encode(
            [
                'message' => 'status is required'
            ]
        );
    } else if ($status !== 'done' && $status !== 'delivered' && $status !== 'processing') {
        echo json_encode(
            [
                'message' => "Status must be done or delivered or processing"
            ]
        );
    } else {
                // insert in orders
                $addOrder = $database->insertRow('orders', "insert into orders (userId,date,status) values 
    (?,?,?)", [
            $userID,
            $date,
            $status
        ]);
                // get last order  
        $get_id = $database->getrows('orders', "select MAX(orderID) from orders");

       $order_id = $get_id->fetch(PDO::FETCH_COLUMN);
       // single value prodeuct 
       foreach($products as $key => $value){

       $database->insertRow('order_product', "insert into order_product (order_id,product_id,quantity) values 
    (?,?,?)", [
            $order_id,
            $value['id'],
            $value['quantity']
        ]);

        // decrease product quantity after insert 
              
        echo "Added order successfully.";
      }}
} else {
    echo "Error creating ";
}










    











   





