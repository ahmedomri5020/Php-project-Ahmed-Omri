<?php
require_once('../controllers/admincontroller.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adminController = new AdminController();
    $cin = $_POST['username'];
    $password = $_POST['password'];
    $adminController->login($cin, $password);
}
?>
