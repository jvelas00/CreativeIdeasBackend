<?php
class Item
{
    public $name;
    public $itemTotal;
    public $qty;

    public function __construct($name, $itemTotal, $qty) 
    {
        $this->name = $name;
        $this->itemTotal = $itemTotal;
        $this->qty = $qty;
    }
}
?>