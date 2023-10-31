<?php
require_once __DIR__ . '/../../Models/Order.php';
require_once __DIR__ . '/../../Models/OrderSummary.php';
require_once __DIR__ . '/../DataAccess/OrdersDA.php';
require_once __DIR__ . '/../Shared/JSONResponse.php';

$ordersDA = new OrdersDA();

$json = json_decode(file_get_contents('php://input'), true);

if($json === null) {
    echo "No JSON data";
} else {
    if(isset($json['customerId'])) {
        $customerId = $json['customerId'];
        $orders = $ordersDA->getCustomerOrders($customerId);
        $orderSummaries = $ordersDA->getOrderSummaries($orders);

        if($orderSummaries) {
            $view = new JSONResponse();
            $view->render($orderSummaries);
        } else {
            http_response_code(404);
            echo "No orders found";
        }

    } else {
        echo "Missing param: customerId";
    }

}


?>