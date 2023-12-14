<?php
require_once('../database/config.php');
require_once('../controllers/admincontroller.php');
$adminController = new AdminController();
$searchID = isset($_GET['searchID']) ? $_GET['searchID'] : null;
$adminController->liste($searchID);
?>
