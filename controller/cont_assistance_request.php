<?php
require_once("include/pdo.php");
$pdo = PdoGsb::getPdoGsb();

if (isset($_POST['password'])) {

    $user = $pdo->sel_user("cartunlocker");

    if (password_verify($_POST['password'], $user['password'])) {
        $last_support_request = $pdo->sel_last_support_request($_SESSION['id'], $_SESSION['cart']);
        $pdo->upd_support_request($last_support_request[0]['id']);
        $pdo->upd_state_cart($_SESSION['cart'], 3);
        header("Location: ?controller=cart_screen");
    } else {
        $er = 1;
        echo "err";
    }
} else {
    $pdo->ins_support_request($_SESSION['id'], $_SESSION['cart']);
    $pdo->upd_state_cart($_SESSION['cart'], 4);
}

$view = "view_assistance_request.php";
