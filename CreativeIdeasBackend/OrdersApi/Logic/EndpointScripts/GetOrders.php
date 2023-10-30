<?php
require_once __DIR__ . '/../../Models/Order.php';
require_once __DIR__ . '/../DataAccess/OrdersDA.php';
require_once __DIR__ . '/../Shared/JSONResponse.php';

$ordersDA = new OrdersDA();

$orders = $ordersDA->getOrders();
$view = new JSONResponse();
$view->render($orders);

?>