<?php 
require_once("include/pdo.php");
$pdo = PdoGsb::getPdoGsb();

if(isset($_GET['cancel'])) {
    $last_basket = $pdo->sel_last_basket($_SESSION['id'], $_SESSION['cart']);
    $pdo->upd_cancel_basket($last_basket[0]['id']);
    $pdo->upd_state_cart($_SESSION['cart'],5);
    header("Location: ?controller=disconnection");
}

$view = "view_cancel_basket.php";
