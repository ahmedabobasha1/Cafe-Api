<?php
header('Access-Control-Allow-Methods: DELETE');
require('../../handle.php');


$db = new Database();






////////////////////////neeeds validation and password decription!!!!!!!!!!!!!!!!
//var_dump($_SERVER['REQUEST_METHOD']);
//var_dump();
if ($_SERVER["REQUEST_METHOD"] === 'delete'){

if ($_GET['id']) {
    $id = $_GET['id'];


    // $query = "insert into users
    // (name,email, password, room_number, ext, image)       
    //  values
    // (\"$name\", \"$email\", \"$password\", \"$room_number\", $ext, \"$image\");";

    $query1 = "delete from users where id = $id";

    echo $db->deleteRow('', $query1);
} else {
    echo json_encode("please use id");
}
}
else{
    echo json_encode("wrong http method");
}