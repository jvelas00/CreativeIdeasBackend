<?php
class User {
    public $user_id;
    public $username;
    public $password;
    public $name;

    public function __construct($order_id, $accepted, $pending, $date_ordered) {
        $this->user_id = $order_id;
        $this->username = $accepted;
        $this->password = $pending;
        $this->name = $date_ordered;
    }
    public function getuserId() {
        return $this->user_id;
    }
    public function setuserId($user_id) {
        $this->user_id = $user_id;
    }
    public function getUsername() {
        return $this->username;
    }
    public function setUsername($username) {
        $this->username = $username;
    }
    public function getPassword() {
        return $this->password;
    }
    public function setPassword($password) {
        $this->password = $password;
    }
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }
}
