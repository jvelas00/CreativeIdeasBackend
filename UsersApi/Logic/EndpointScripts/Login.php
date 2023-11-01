<?php
require_once __DIR__ . '/../../Models/user.php';
require_once __DIR__ . '/../DataAccess/UsersDA.php';
require_once __DIR__ . '/../Shared/JSONResponse.php';

$UsersDA = new UsersDA();



$requestBody = file_get_contents('php://input');
$data = json_decode($requestBody, true);
if ($data !== null) {
    if (isset($data['username']) && isset($data['password'])) {
        $inv_id = $data['username'];
        $qty = $data['password'];
        $user = $UsersDA->login($inv_id, $qty);
        if ($user) {
            $view = new JSONResponse();
            $view->render($user);
        } else {
            echo 'Incorrect username or password';
        }
    } else {
        echo "No 'id' found in the request body.";
    }
} else {
    echo "Invalid JSON data in the request body.";
}
