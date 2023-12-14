<?php
require_once('../controllers/admincontroller.php');
require_once('../models/admin.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adminController = new AdminController();
    $ncin = $_POST['ncin'];
    $password=$_POST['password'];
    $name = $_POST['name'];
    $adresse = $_POST['adresse'];
    $contactinfo = $_POST['contactinfo'];
    $admin = new Admin($ncin,$password, $name, $adresse, $contactinfo);
    $res = $adminController->insert($admin);
    header("Location:admin.html");

}
?>
