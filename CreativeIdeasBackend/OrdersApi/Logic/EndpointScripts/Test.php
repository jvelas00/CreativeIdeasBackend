<?php
require __DIR__ . '/../Shared/JSONResponse.php';

$view = new JSONResponse();
$view->render("This is a test response from the OrdersApi!")

?>