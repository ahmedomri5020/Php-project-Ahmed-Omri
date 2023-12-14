<?php
require_once('../controllers/accountcontroller.php');
require_once('../models/account.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accountController = new AccountController();
    $balance = $_POST['balance'];
    $customerCIN = $_POST['customerCIN'];
    $account=new Account($balance,$customerCIN);
    $result = $accountController->insert($account);
    header("Location:admin.html");

}
?>
