<?php
require_once("include/pdo.php");
$pdo = PdoGsb::getPdoGsb();

if(isset($_GET['confirm'])){
    $pdo->ins_sale($_GET['basket'],$_GET['amount']);
    $pdo->upd_sell_basket($_GET['basket']);
    $pdo->upd_state_cart($_SESSION['cart'],5);
    header("Location: ?controleur=disconnection");
}

$view="view_payment.php";