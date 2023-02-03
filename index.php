<?php
session_start(); // Démarrage des variables sessions
date_default_timezone_set("Europe/Paris");

switch (isset($_GET['controleur'])) {
    case true:
        $controleur = $_GET['controleur'];
        break;

    case false:
        $controleur = "connexion_client";
        break;
}

switch ($controleur) {

    case "connexion":
        include "controleur/con_connexion.php";
        break;

        case "connexion_client":
            include "controleur/con_connexion_client.php";
            break;

    case "deconnexion":
        session_destroy(); // Détruit la variable de session
        unset($_SESSION);  // Supprime les valeurs en cours d'utilisation
        session_start();   // Crée une nouvelle variable de sessio vierge
        include "controleur/con_deconnexion.php";
        break;

    case "stock":
        include "controleur/con_stock.php";
        break;

    default:
        include "controleur/con_erreur_controleur.php";
        break;
}
if (isset($vue)) {
    include "vue/vue_template.php";
}
