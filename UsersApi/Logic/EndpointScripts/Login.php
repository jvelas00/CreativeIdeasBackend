<?php
require_once __DIR__ . '/../../Models/user.php';
require_once __DIR__ . '/../DataAccess/UsersDA.php';
require_once __DIR__ . '/../Shared/JSONResponse.php';

$UsersDA = new UsersDA();



$requestBody = file_get_contents('php://input');
$data = json_decode($requestBody, true);
if ($data !== null) {
    if (isset($data['username']) && isset($data['password'])) {
        $username = $data['username'];
        $password = $data['password'];
        if($UsersDA->login($username, $password)){
            echo 'Successful Login attempt';
        }else{
            echo 'Incorrect username or password';
        }
    } else {
        echo "No 'id' found in the request body.";
    }
} else {
    echo "Invalid JSON data in the request body.";
}
