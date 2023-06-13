<?php
require('../../handle.php');
header('Access-Control-Allow-Methods: GET');

$db = new Database();



if ($_SERVER["REQUEST_METHOD"] === 'GET'){
    if ($_GET['id']) {
        $id = $_GET['id'];
        $rows = $db->getrow('', "select * from users where id = $id;")->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($rows);
        echo $json;
    } else {
        $rows = ($db->getrows('', 'select * from users;'))->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($rows);
        echo $json;
    }
}

else{
    echo json_encode("wrong http method");
}