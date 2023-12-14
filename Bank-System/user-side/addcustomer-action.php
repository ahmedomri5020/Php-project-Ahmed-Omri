<?php
require_once('../controllers/customercontroller.php');
require_once('../models/customer.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customercontroller = new CustomerController();
    $ncin = $_POST['ncin'];
    $password=$_POST['password'];
    $name = $_POST['name'];
    $adresse = $_POST['adresse'];
    $contactinfo = $_POST['contactinfo'];
    $customer = new Customer($ncin,$password, $name, $adresse, $contactinfo);
    $res = $customercontroller->insert($customer);
    header("Location:admin.html");

    if ($res == true) {
        echo "success";
    } else {
        echo "error";
    }
}
?>
