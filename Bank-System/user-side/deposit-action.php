<?php
require_once('../database/config.php');
require_once('../controllers/accountcontroller.php');

$accountController = new AccountController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accountID = $_POST['accountNumber'];
    $amount = $_POST['deposit'];

    $withdrawResult = $accountController->deposit($accountID, $amount);
    header("Location:user.html");
}
?>
