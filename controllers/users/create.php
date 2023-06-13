<?php
require('../../handle.php');

header('Access-Control-Allow-Methods: POST');


$db = new Database();





if ($_SERVER["REQUEST_METHOD"] === 'POST'){

$data = json_decode(file_get_contents('php://input'));

// Clean data
$name = htmlspecialchars(strip_tags($data->name));
$email = htmlspecialchars(strip_tags($data->email));
$password = htmlspecialchars(strip_tags($data->password));
$password = password_hash($password, PASSWORD_BCRYPT);
$room_number = htmlspecialchars(strip_tags($data->room_number));
$ext = htmlspecialchars(strip_tags($data->ext));
$image = htmlspecialchars(strip_tags($data->image));

$password = password_hash($password, PASSWORD_DEFAULT);

$query = "insert into users
(name,email, password, room_number, ext, image)       
 values
(\"$name\", \"$email\", \"$password\", \"$room_number\", $ext, \"$image\");";

if($db->insertRow('', $query)){
    echo file_get_contents('php://input');
    echo json_encode("done") ;
} 
else{
   echo json_encode("error");
} 

}
else{
    echo json_encode("wrong http method");
}