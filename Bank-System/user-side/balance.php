<?php
    require_once('../database/config.php');
    require_once('../controllers/accountcontroller.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cin'])) {
    $cin = $_POST['cin'];
    $accountcontroller = new AccountController();
    $accountcontroller->balance($cin);
}
?>