<?php
require_once("include/pdo.php");
$pdo = PdoGsb::getPdoGsb();


$basket= $pdo->sel_basket($_SESSION['cart'], $_SESSION['id']);

$items_basket= $pdo->sel_items_basket($basket[0]['id']);

$total_amount=0;
$number_items=0;

foreach($items_basket as $item) {
    $total_amount += $item['price'];
    $number_items += 1;
}

if(isset($_POST['item'])) {
    $pdo->ins_item_in_basket($_POST['item'], $basket[0]['id'],date("Y-m-d"));
    header("Location: ?controller=cart_screen");
}

if(isset($_GET['delete'])) {
    $pdo->upd_item_in_basket($_GET['id'],date("Y-m-d H:i:s"));
    header("Location: ?controller=cart_screen");

}

$view = "view_cart_screen.php";
