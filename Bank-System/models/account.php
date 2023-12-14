<?php
require_once('../database/config.php');

class Account {
    private $balance;
    private $customerCIN;
    public function __construct($balance="", $customerCIN = "") {
        $this->balance = $balance;
        $this->customerCIN = $customerCIN;
    }
    public function getBalance() {
        return $this->balance;
    }
    public function setBalance($balance) {
        $this->balance = $balance;
    }
    public function getCustomerCIN() {
        return $this->customerCIN;
    }
    public function setCustomerCIN($customerCIN) {
        $this->customerCIN = $customerCIN;
    }
}
?>