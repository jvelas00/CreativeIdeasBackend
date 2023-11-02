<?php
require_once __DIR__ . '/../../Models/inventory.php';
require_once __DIR__ . '/../DataAccess/InventoryDA.php';
require_once __DIR__ . '/../Shared/JSONResponse.php';

$inventoryDA = new InventoryDA();



$requestBody = file_get_contents('php://input');
$data = json_decode($requestBody, true);
if ($data !== null) {
    if (isset($data['name']) && isset($data['description']) && isset($data['price'])  && isset($data['qty'])) {
        $name = $data['name'];
        $description = $data['description'];
        $price = $data['price'];
        $qty = $data['qty'];
        $inventoryDA->addItem($name, $description, $price, $qty);

    } else {
        echo "Missing Parameters";
    }
} else {
    echo "Invalid JSON data in the request body.";
}
