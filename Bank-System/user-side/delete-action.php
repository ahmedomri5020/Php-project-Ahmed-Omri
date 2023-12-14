<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accountID'])) {
    require_once('../database/config.php');
    require_once('../controllers/accountcontroller.php');

    $accountController = new AccountController();

    $accountIDToDelete = $_POST['accountID'];
    $deletionResult = $accountController->deleteAccount($accountIDToDelete);
    header("Location:accountlist.php");}
?>