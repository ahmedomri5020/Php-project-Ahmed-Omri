<?php
require_once('../database/config.php');
require_once('../controllers/customercontroller.php');

$customerController = new CustomerController();

$searchID = isset($_GET['searchID']) ? $_GET['searchID'] : null;

$customerController->liste($searchID);
?>
