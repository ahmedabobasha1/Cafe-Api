<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// require(dirname(__DIR__) . '/model/DataBase.php');

require(dirname(__DIR__) . '/model/DataBase.php');



$db = new Database();

var_dump($db);