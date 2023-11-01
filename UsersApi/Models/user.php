<?php
class User {
    public $inv_id;
    public $name;
    public $description;
    public $price;

    public function __construct($order_id, $accepted, $pending, $date_ordered) {
        $this->inv_id = $order_id;
        $this->name = $accepted;
        $this->description = $pending;
        $this->price = $date_ordered;
    }
    public function getuserId() {
        return $this->inv_id;
    }
    public function setuserId($user_id) {
        $this->inv_id = $user_id;
    }
    public function getUsername() {
        return $this->name;
    }
    public function setUsername($username) {
        $this->name = $username;
    }
    public function getPassword() {
        return $this->description;
    }
    public function setPassword($password) {
        $this->description = $password;
    }
    public function getName() {
        return $this->price;
    }

    public function setName($name) {
        $this->price = $name;
    }
}
