<?php
require_once __DIR__ . '/../DataAccess/OrdersDA.php';
require_once __DIR__ . '/../Shared/JSONResponse.php';
require_once __DIR__ . '/../../../UsersApi/Logic/DataAccess/UsersDA.php';
require_once __DIR__ . '/../../../InventoryApi/Logic/DataAccess/InventoryDA.php';
require_once __DIR__ . '/../../../InventoryApi/Models/inventory.php';
require_once __DIR__ . '/../../Models/Item.php';
require_once __DIR__ . '/../../Models/OrderReceipt.php';


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
            $returnedItem = $inv[0];
            $qtyNeeded = 0;
            $currentQty = $returnedItem->getQty();
            if($returnedItem->getQty() < $qty){
                while($currentQty < $qty){
                    $currentQty += 10; // add reorder qty?
                }
                $inventoryDA->editQty($invId, $currentQty);
            }
            $inventoryDA->editQty($invId, $currentQty - $qty);
            $itemTotal = $returnedItem->getPrice() * $qty;
            $total += $itemTotal;
            $detailsItem = new Item($returnedItem->getName(), $itemTotal, $qty);
            $createdItems[] =  $detailsItem;
        }

        $ordersDA->addOrder($custId, $total);
        $order = $ordersDA->getLatestOrder($custId);

        foreach($items as $item) {
            $ordersDA->addOrderDetail($order->getOrderID(), $item['invID'], $item['qty']);
        }

        $receipt = new OrderReceipt($createdItems, $total);

        if($receipt) {
            $view = new JSONResponse();
            $view->render($receipt);
        }
    } else {
        echo "Missing Parameters";
    }
}

?>