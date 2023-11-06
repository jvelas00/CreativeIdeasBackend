<?php
require_once __DIR__ . '/../../Models/user.php';
require_once __DIR__ . '/../DataAccess/UsersDA.php';
require_once __DIR__ . '/../Shared/JSONResponse.php';

$UsersDA = new UsersDA();



$requestBody = file_get_contents('php://input');
$data = json_decode($requestBody, true);
if ($data !== null) {
    if (isset($data['username']) && isset($data['password']) && isset($data['name'])) {
        $username = $data['username'];
        $password = $data['password'];
        $name = $data['name'];
        $UsersDA->createUser($username, $password, $name);

    } else {
        echo "Missing Parameters";
    }
} else {
    echo "Invalid JSON data in the request body.";
}
