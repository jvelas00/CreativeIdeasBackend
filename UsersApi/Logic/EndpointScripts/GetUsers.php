<?php
require_once __DIR__ . '/../../Models/user.php';
require_once __DIR__ . '/../DataAccess/UsersDA.php';
require_once __DIR__ . '/../Shared/JSONResponse.php';

$UsersDA = new UsersDA();

$UsersDA = $UsersDA->getUsers();
$view = new JSONResponse();
$view->render($orders);

?>