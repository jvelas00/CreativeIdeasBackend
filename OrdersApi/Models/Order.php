<?php
class Order {
    public $order_id;
    public $customer_id;
    public $accepted;
    public $pending;
    public $date_ordered;
    public $total;

    public function __construct($order_id, $customer_id, $accepted, $pending, $date_ordered, $total) {
        $this->order_id = $order_id;
        $this->customer_id = $customer_id;
        $this->accepted = $accepted;
        $this->pending = $pending;
        $this->date_ordered = $date_ordered;
        $this->total = $total;
    }

    public function getOrderID() {
        return $this->order_id;
    }

    public function setOrderID($order_id) {
        $this->order_id = $order_id;
    }

    public function getCustomerID() {
        return $this->customer_id;
    }

    public function setCustomerID($customer_id) {
        $this->customer_id = $customer_id;
    }

    public function isAccepted() {
        return $this->accepted;
    }

    public function setAccepted($accepted) {
        $this->accepted = $accepted;
    }

    public function isPending() {
        return $this->pending;
    }

    public function setPending($pending) {
        $this->pending = $pending;
    }

    public function getDateOrdered() {
        return $this->date_ordered;
    }

    public function setDateOrdered($date_ordered) {
        $this->date_ordered = $date_ordered;
    }

    public function getTotal() {
        return $this->total;
    }

    public function setTotal($total) {
        $this->total = $total;
    }
}

?>