<?php
class OrderReceipt
{
    public $items;
    public $total;

    public function __construct($items, $total)
    {
        $this->items = $items;
        $this->total = $total;
    }
}
?>