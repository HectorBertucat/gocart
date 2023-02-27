<?php

require_once("include/pdo.php");
$pdo = PdoGsb::getPdoGsb();

// if chart is set, then not return a view but return the data for the chart
if(isset($_GET['chart'])) {

    // switch on the chart type
    switch($_GET['chart']) {
        case 'items_sold_day':
            // get the data from the database
            $data = $pdo->sel_items_sold_day($_GET['day']);
            break;
        case 'items_sold_week':
            // get the data from the database
            $data = $pdo->sel_items_sold_week($_GET['day']);
            break;
    }
    // return the data as json
    echo json_encode($data);
} else {
    $article_type = $pdo->sel_article_type();
    $carts = $pdo->sel_carts();
    $view = "view_admin_dashboard.php";
}
