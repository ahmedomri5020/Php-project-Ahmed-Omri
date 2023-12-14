<?php
require_once('../database/config.php');
require_once('../controllers/accountcontroller.php');

$accountController = new AccountController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accountID = $_POST['accountNumber'];
    $amount = $_POST['transfer'];
    $accountID2 = $_POST['accountNumber2'];
    $accountController->withdraw($accountID,$amount);
    $accountController->deposit($accountID2,$amount);
    header("Location:user.html");


}
?>
