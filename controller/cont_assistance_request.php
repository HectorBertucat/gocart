<?php
require_once("include/pdo.php");
$pdo = PdoGsb::getPdoGsb();

if(isset($_POST['password'])) {

$user=$pdo->sel_user("cartunlocker");

    if (password_verify($_POST['password'], $user['password'])) { 
        $last_support_request = $pdo->sel_last_support_request($_SESSION['id'],$_SESSION['cart']);
        $pdo->upd_support_request($last_support_request[0]['id']);
        header("Location: ?controller=cart_screen");
    } else {
        $er = 1;
        echo "err";
    }
} else {
    $pdo->ins_support_request($_SESSION['id'],$_SESSION['cart']);

}

$view ="view_assistance_request.php";