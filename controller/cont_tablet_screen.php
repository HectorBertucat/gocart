<?php
require_once("include/pdo.php");
$pdo = PdoGsb::getPdoGsb();

if (!isset($_SESSION['email']) || $_SESSION['id_user_type'] < 2) {
    header("Location: ?controller=disconnection");
    exit();
}

if (isset($_GET['carts'])) {
    switch ($_GET['carts']) {
        case 'list':
            $data = $pdo->sel_carts_state(4);
            break;
    }
    echo json_encode($data);
} else {
    $leslignes = $pdo->sel_carts_state(4);
    $view = "view_tablet_screen.php";
}
