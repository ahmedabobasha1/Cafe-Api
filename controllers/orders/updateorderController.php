<?php

require('../../handle.php');

$database = new Database();

header('Access-Control-Allow-Methods: PATCH');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
if ($uri && $_SERVER['REQUEST_METHOD'] == 'PUT') {

    $data = json_decode(file_get_contents("php://input"));

    $id = $_GET['id'];
    $date = $data->date;
    $status = $data->status;
    $userID = $data->userID;

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
        $updateOrder = $database->updateRow(
            'orders',
            "update orders set userId=?, date=?, status=? where orderID=?",
            [
                $userID,
                $date,
                $status,
                $id
            ]
        );
        $query = "update orders set userId=$userID, date=$date, status=$status where orderID=$id";
        echo json_encode(["message" => "User Updated Successfully "]);
    }
} else {
    echo "Error in update function ";
}
