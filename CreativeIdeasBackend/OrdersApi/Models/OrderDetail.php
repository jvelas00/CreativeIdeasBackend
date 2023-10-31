<?php
class OrderDetail {
    public $order_detail_id;
    public $order_id;
    public $inv_id;
    public $qty;

    public function __construct($order_detail_id, $order_id, $inv_id, $qty) {
        $this->order_detail_id = $order_detail_id;
        $this->order_id = $order_id;
        $this->inv_id = $inv_id;
        $this->qty = $qty;
    }
}
?>