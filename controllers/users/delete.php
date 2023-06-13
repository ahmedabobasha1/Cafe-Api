<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


header('Access-Control-Allow-Methods: DELETE');
require('../../handle.php');


$db = new Database();






////////////////////////neeeds validation and password decription!!!!!!!!!!!!!!!!
//var_dump($_SERVER['REQUEST_METHOD']);
//var_dump();

if ($_GET['id']) {
    $id = $_GET['id'];


    // $query = "insert into users
    // (name,email, password, room_number, ext, image)       
    //  values
    // (\"$name\", \"$email\", \"$password\", \"$room_number\", $ext, \"$image\");";

    $query1 = "delete from users where id = $id";

    var_dump($query1);
    echo $db->deleteRow('', $query1);
} else {
    echo "please use id";
}
