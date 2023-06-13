<?php 
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

require '../model/DataBase.php';

$db = new Database();




if($_GET['id'])
{
    $id = $_GET['id'];
    echo $db->getrow('',"select * from users where id = $id;");
}
else
{
    echo($db->getrows('','select * from users;'));
}
















?>