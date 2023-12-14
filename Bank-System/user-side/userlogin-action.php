<?php
require_once('../controllers/customercontroller.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usercontroller = new CustomerController();
    $cin = $_POST['username'];
    $password = $_POST['password'];
    $usercontroller->login($cin, $password);
}
?>
