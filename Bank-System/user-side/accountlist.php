<?php
    require_once('../database/config.php');
    require_once('../controllers/accountcontroller.php');

    $accountController = new AccountController();
    
    $searchID = isset($_GET['searchID']) ? $_GET['searchID'] : null;

    $accountController->liste($searchID);
    ?>