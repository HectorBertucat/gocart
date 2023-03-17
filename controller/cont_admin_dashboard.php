<?php

require_once("include/pdo.php");
$pdo = PdoGsb::getPdoGsb();

if(!isset($_SESSION['email']) || $_SESSION['id_user_type'] != 3) {
    header("Location: ?controller=deconnection");
    exit();
}

// if chart is set, then not return a view but return the data for the chart
if(isset($_GET['chart'])) {

    // switch on the chart type
    switch($_GET['chart']) {
        case 'items_sold_day_amount':
            // get the data from the database
            $data = $pdo->sel_items_sold_day_amount($_GET['day'], $_GET['article_type_id'], $_GET['cart_id']);
            break;
        case 'items_sold_week_amount':
            // get the data from the database
            $data = $pdo->sel_items_sold_week_amount($_GET['day'], $_GET['article_type_id'], $_GET['cart_id']);
            break;
        case 'items_sold_day_quantity':
            // get the data from the database
            $data = $pdo->sel_items_sold_day_quantity($_GET['day'], $_GET['article_type_id'], $_GET['cart_id']);
            break;
        case 'items_sold_week_quantity':
            // get the data from the database
            $data = $pdo->sel_items_sold_week_quantity($_GET['day'], $_GET['article_type_id'], $_GET['cart_id']);
            break;
        case 'turnover':
            // get the data from the database
            $data = $pdo->sel_turnover($_GET['start'], $_GET['end']);
            break;
        case 'nb_carts_with_status':
            // get the data from the database
            $data = $pdo->sel_nb_carts_with_status($_GET['status_id']);
            break;
    }
    // return the data as json
    echo json_encode($data);
} else {
    $article_type = $pdo->sel_article_type();
    $cartStatus = $pdo->sel_cart_status();
    $carts = $pdo->sel_carts();
    $active_carts = $pdo->sel_nb_carts_with_status(3);
    $view = "view_admin_dashboard.php";
}
