<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require '../model/DataBase.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');



$db = new Database();






////////////////////////neeeds validation and password decription!!!!!!!!!!!!!!!!
//var_dump($_SERVER['REQUEST_METHOD']);
//var_dump();

if($_GET['id'])
{
$id = $_GET['id'];


// $query = "insert into users
// (name,email, password, room_number, ext, image)       
//  values
// (\"$name\", \"$email\", \"$password\", \"$room_number\", $ext, \"$image\");";

$query1 = "delete from users where id = $id";

var_dump($query1);
echo $db->deleteRow('', $query1);

}
else
{
    echo "please use id";
}



?>