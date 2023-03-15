<?php
session_start(); // Démarrage des variables sessions
date_default_timezone_set("Europe/Paris");

switch (isset($_GET['controller'])) {
    case true:
        $controller = $_GET['controller'];
        break;

    case false:
        $controller = "connection_client";
        break;
}

switch ($controller) {

    case "connection":
        include "controller/cont_connection.php";
        break;

    case "connection_client":
        include "controller/cont_connection_client.php";
        break;

    case "disconnection":
        $cart = $_SESSION['cart'];
        session_destroy(); // Détruit la variable de session
        unset($_SESSION);  // Supprime les valeurs en cours d'utilisation
        session_start();   // Crée une nouvelle variable de sessio vierge
        $_SESSION['cart'] = $cart;
        include "controller/cont_disconnection.php";
        break;

    case "admin_dashboard":
        include "controller/cont_admin_dashboard.php";
        break;

    case "tablet_screen":
        include "controller/cont_tablet_screen.php";
        break;


    case "assistance_confirmation":
        include "controller/cont_assistance_confirmation.php";
        break;


    case "error_connection_client":
        include "controller/cont_error_connection_client.php";
        break;

    case "cart_screen":
        include "controller/cont_cart_screen.php";
        break;

    case "howto":
        include "controller/cont_howto.php";
        break;


    case "basket_confirmation":
        include "controller/cont_basket_confirmation.php";
        break;

    case "payment":
        include "controller/cont_payment.php";
        break;

    case "assistance_request":
        include "controller/cont_assistance_request.php";
        break;

    case "cancel_basket":
        include "controller/cont_cancel_basket.php";
        break;

    default:
        include "controller/cont_error_controller.php";
        break;
}
if (isset($view)) {
    include "view/view_template.php";
}
