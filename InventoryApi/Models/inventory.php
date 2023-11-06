<?php
class Inventory
{
    public $inv_id;
    public $name;
    public $description;
    public $price;
    public $qty;

    public function __construct($inv_id, $name, $description, $price, $qty)
    {
        $this->inv_id = $inv_id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->qty = $qty;
    }
    public function getInvId()
    {
        return $this->inv_id;
    }

    public function setInvId($inv_id)
    {
        $this->inv_id = $inv_id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getQty()
    {
        return $this->qty;
    }

    public function setQty($qty)
    {
        $this->qty = $qty;
    }
}
