<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require '../model/DataBase.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');



$db = new Database();






////////////////////////neeeds validation and password decription!!!!!!!!!!!!!!!!
//var_dump($_SERVER['REQUEST_METHOD']);
//var_dump();

if($_GET['id'])
{
$id = $_GET['id'];
$data = json_decode(file_get_contents('php://input'));

// Clean data
$name = htmlspecialchars(strip_tags($data->name));
$email = htmlspecialchars(strip_tags($data->email));
$password = htmlspecialchars(strip_tags($data->password));
$room_number = htmlspecialchars(strip_tags($data->room_number));
$ext = htmlspecialchars(strip_tags($data->ext));
$image = htmlspecialchars(strip_tags($data->image));

// $query = "insert into users
// (name,email, password, room_number, ext, image)       
//  values
// (\"$name\", \"$email\", \"$password\", \"$room_number\", $ext, \"$image\");";

$query1 = "update users
set name = '$name', email = '$email', password = '$password', room_number = '$room_number', ext = $ext, image = '$image'
where id = $id";


echo $db->updateRow('', $query1);

}
else
{
    echo "please use id";
}



?>