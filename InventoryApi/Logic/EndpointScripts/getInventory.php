<?php
require_once __DIR__ . '/../../Models/inventory.php';
require_once __DIR__ . '/../DataAccess/InventoryDA.php';
require_once __DIR__ . '/../Shared/JSONResponse.php';

$InventoryDA = new InventoryDA();

$inventory = $InventoryDA->getInventory();
$view = new JSONResponse();
$view->render($inventory);

?>