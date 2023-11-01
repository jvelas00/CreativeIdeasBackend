<?php
require_once __DIR__ . '/../../Models/inventory.php';
require_once __DIR__ . '/../DataAccess/InventoryDA.php';
require_once __DIR__ . '/../Shared/JSONResponse.php';

$inventoryDA = new inventoryDA();



$requestBody = file_get_contents('php://input');
$data = json_decode($requestBody, true);
if ($data !== null) {
    if (isset($data['inv_id']) && isset($data['qty'])) {
        $inv_id = $data['inv_id'];
        $qty = $data['qty'];
        $inventoryDA->editQty($inv_id, $qty);
    } else {
        echo "No 'id' found in the request body.";
    }
} else {
    echo "Invalid JSON data in the request body.";
}
