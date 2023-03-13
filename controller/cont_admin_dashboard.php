<?php

require_once("include/pdo.php");
$pdo = PdoGsb::getPdoGsb();

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
    }
    // return the data as json
    echo json_encode($data);
} else {
    $article_type = $pdo->sel_article_type();
    $carts = $pdo->sel_carts();
    $view = "view_admin_dashboard.php";
}
