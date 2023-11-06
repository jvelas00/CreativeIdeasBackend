<?php
class User {
    public $customer_id;
    public $username;
    public $password;
    public $name;
    public $admin;

    public function __construct($customer_id, $username, $password, $name, $admin) {
        $this->customer_id = $customer_id;
        $this->username = $username;
        $this->password = $password;
        $this->name = $name;
        $this->admin = $admin;
    }
    public function getCustomerID() {
        return $this->customer_id;
    }

    public function setCustomerID($customer_id) {
        $this->customer_id = $customer_id;
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

    public function isAdmin() {
        return $this->admin;
    }

    public function setAdmin($admin) {
        $this->admin = $admin;
    }
}
