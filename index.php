<?php
session_start(); // Démarrage des variables sessions
date_default_timezone_set("Europe/Paris");

switch (isset($_GET['controleur'])) {
    case true:
        $controleur = $_GET['controleur'];
        break;

    case false:
        $controleur = "connexion";
        break;
}


switch ($controleur) {

    case "connexion":
        include "controleur/con_connexion.php";
        break;

    case "deconnexion":
        session_destroy(); // Détruit la variable de session
        unset($_SESSION);  // Supprime les valeurs en cours d'utilisation
        session_start();   // Crée une nouvelle variable de sessio vierge
        include "controleur/con_deconnexion.php";
        break;

    case "entree":
        include "controleur/con_entree.php";
        break;

    case "del_categorie":
        include "controleur/con_del_categorie.php";
        break;

    case "modifier_categorie":
        include "controleur/con_modifier_categorie.php";
        break;

    case "parametres":
        include "controleur/con_parametres.php";
        break;

    case "download_entree":
        include "controleur/con_download_entree.php";
        break;

        case "download_sortie":
            include "controleur/con_download_sortie.php";
            break;

        case "download_stock":
            include "controleur/con_download_stock.php";
            break;

    case "categorie":
        include "controleur/con_categorie.php";
        break;

    case "article":
        include "controleur/con_article.php";
        break;

    case "sortie":
        include "controleur/con_sortie.php";
        break;

    case "stock":
        include "controleur/con_stock.php";
        break;

    case "ajout_article":
        include "controleur/con_ajout_article.php";
        break;

        case "ajout_article_stock":
            include "controleur/con_ajout_article_stock.php";
            break;

    default:
        include "controleur/con_erreur_controleur.php";
        break;
}
if (isset($vue)) {
    include "vue/vue_template.php";
}
