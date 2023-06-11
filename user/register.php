<?php
header("Content-Type: application/json");
require '../model/DataBase.php';

$db = new Database();

// handle registration
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);



    // check if username or email already exist
    $result = $db->getrow('users', "SELECT * FROM users WHERE name = ? OR email = ? ", [$username, $email]);

    if ($result) {
        http_response_code(400);
        echo json_encode(["error" => "Username or email already exists"]);
        exit();
    }

    // insert new user into database

    $new_user = $db->insertRow('users', 'INSERT INTO users (name, email, password) VALUES (? , ? , ?)', [$username, $email, $password]);


    http_response_code(201);
    echo json_encode(["message" => "User created successfully",]);
    exit();
}

// handle other requests
http_response_code(404);
echo json_encode(["error" => "Route not found"]);
exit();
