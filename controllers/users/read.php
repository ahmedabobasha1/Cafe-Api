<?php


require('../../handle.php');
header('Access-Control-Allow-Methods: GET');

$db = new Database();




if ($_GET['id']) {
    $id = $_GET['id'];
    echo $db->getrow('', "select * from users where id = $id;");
} else {
    echo ($db->getrows('', 'select * from users;'));
}
