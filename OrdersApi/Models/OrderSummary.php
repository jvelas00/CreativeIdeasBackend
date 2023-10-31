<?php
class OrderSummary {
    public $itemName;
    public $qty;
    public $totalPrice;
    public $status;

    public function __construct($itemName, $qty, $totalPrice, $status) {
        $this->itemName = $itemName;
        $this->qty = $qty;
        $this->totalPrice = $totalPrice;
        $this->status = $status;
    }

}
?>