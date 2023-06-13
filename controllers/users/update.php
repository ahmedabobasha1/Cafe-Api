<?php
header('Access-Control-Allow-Methods: PUT');
require('../../handle.php');


$db = new Database();






////////////////////////neeeds validation and password decription!!!!!!!!!!!!!!!!
//var_dump($_SERVER['REQUEST_METHOD']);
//var_dump();
if ($_SERVER["REQUEST_METHOD"] === 'PUT'){

if ($_GET['id']) {
    $id = $_GET['id'];
    $data = json_decode(file_get_contents('php://input'));

    // Clean data
    $name = htmlspecialchars(strip_tags($data->name));
    $email = htmlspecialchars(strip_tags($data->email));
    $password = htmlspecialchars(strip_tags($data->password));
    $room_number = htmlspecialchars(strip_tags($data->room_number));
    $ext = htmlspecialchars(strip_tags($data->ext));
    $image = htmlspecialchars(strip_tags($data->image));


    $query1 = "update users
set name = '$name', email = '$email', password = '$password', room_number = '$room_number', ext = $ext, image = '$image'
where id = $id";


    echo $db->updateRow('', $query1);
} else {
    echo json_encode("please use id");
}
}
else{
    echo json_encode("wrong http method");
}