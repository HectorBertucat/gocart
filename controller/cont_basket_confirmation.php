<?php
require_once("include/pdo.php");
$pdo = PdoGsb::getPdoGsb();

if ($_GET['amount'] > 0) {

    if (isset($_GET['confirm'])) {
        header("Location: ?controller=payment&basket=$_GET[basket]&amount=$_GET[amount]");
    }

    $view = "view_basket_confirmation.php";
} else {
    $view = "view_error_basket_confirmation.php";
}
