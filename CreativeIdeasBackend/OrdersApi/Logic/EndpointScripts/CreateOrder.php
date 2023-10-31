<?php
require_once __DIR__ . '/../DataAccess/OrdersDA.php';
require_once __DIR__ . '/../Shared/JSONResponse.php';
//require_once __DIR__ . '/../../../CustomersApi/Logic/DataAccess/CustomersDA.php';

$ordersDA = new OrdersDA();
//$customersDA = new CustomersDA();

$json = json_decode(file_get_contents('php://input'), true);

if($json === null) {
    echo "No JSON data";
} else {
    
}

?>