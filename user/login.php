<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


require_once '../vendor/autoload.php';

use Firebase\JWT\JWT;

header("Content-Type: application/json");

require '../model/DataBase.php';

$db = new Database();


// handle login
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["email"]) && isset($_POST["password"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // retrieve user from database

    $result = $db->getrow('users', "SELECT * FROM users WHERE email = ?", [$email]);



    if (!$result) {
        http_response_code(401);
        echo json_encode(["error" => "Invalid email"]);
        exit();
    }



    // verify password
    if (!password_verify($password, $result["password"])) {
        http_response_code(401);
        echo json_encode(["error" => "Invalid password"]);
        exit();
    }

    // generate JWT token

    $jwt_secret = 'verygoodsecretkey';

    $jwt_payload = [
        'username' => $result['name'],
        'email' => $result['email'],
        'isAdmin' => $result['is_admin']
    ];

    $jwt_token = JWT::encode($jwt_payload, $jwt_secret, 'HS256');

    echo json_encode(["token" => $jwt_token, "user" => $jwt_payload]);

    exit();
}

// handle other requests
http_response_code(404);
echo json_encode(["error" => "Route not found"]);
exit();
