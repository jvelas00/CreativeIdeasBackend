<?php
require_once __DIR__ . '/../DataAccess/OrdersDA.php';
require_once __DIR__ . '/../Shared/JSONResponse.php';
require_once __DIR__ . '/../../../UsersApi/Logic/DataAccess/UsersDA.php';
require_once __DIR__ . '/../../../InventoryApi/Logic/DataAccess/InventoryDA.php';


$ordersDA = new OrdersDA();
$usersDA = new UsersDA();
$inventoryDA = new InventoryDA();

$inputData = file_get_contents('php://input');
$json = json_decode($inputData, true);

if($json === null) {
    echo "No JSON data";
} else {
    if(isset($json['items']) && isset($json['customerID'])) {
        $items = $json['items'];
        $custId = $json['customerID'];
        $total = 0;
        $createdItems = [];

        foreach ($items as $item){
            $invId = $item['invID'];
            $qty = $item['qty'];

            $inv = $inventoryDA->getItem($invId);
            $qtyNeeded = 0;
            $currentQty = $inv->getQty();
            if($inv->getQty() < $qty){
                while($currentQty < $qty){
                    $currentQty += $inv->getReorderQty();
                }
                $inventoryDA->editQty($invId, $currentQty);
            }
            $inv = $inventoryDA->editQty($invID, $currentQty - $qty);
            $itemTotal = $inv->getPrice() * $qty;
            $total += $itemTotal;
            $item = new Item($inv->getName(), $itemTotal, $qty);
            $createdItems[] =  $item;
        }

        $ordersDA->addOrder($custId, $total);
        $order = $ordersDA->getLatestOrder($custId);

        foreach($items as $item) {
            $ordersDA->addOrderDetail($order->getOrderID(), $item['invID'], $item['qty']);
        }
    } else {
        echo "Missing Parameters";
    }
}

?>