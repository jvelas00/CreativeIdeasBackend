<?php
require_once __DIR__ . '/../../Models/Order.php';
require_once __DIR__ . '/../DataAccess/OrdersDA.php';
require_once __DIR__ . '/../Shared/JSONResponse.php';

$ordersDA = new OrdersDA();

$json = json_decode(file_get_contents('php://input'), true);

if($json === null) {
    echo "No JSON data";
} else {
    if(isset($json['orderId'])) {
        $orderId = $json['orderId'];
        $order = $ordersDA->getOrder($orderId);
        if($order){
            $view = new JSONResponse();
            $view->render($order);            
        } else {
            http_response_code(404);
            echo "No matching orderId found";
        }

    } else {
        echo "Missing param: orderId";
    }
}

?>