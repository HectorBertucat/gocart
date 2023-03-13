<?php
$erreur = "";
if (isset($_GET['er'])) {
    switch ($_GET['er']) {
        case 1:
            $erreur = "Numéro de carte inconnu";
            break;
        case 2:
            $erreur = "Identifiant du chariot manquant";
            break;
        default:
            $erreur = "Une erreur est survenue";
    }
}

$view = "view_error_connection_client.php";
