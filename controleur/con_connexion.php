<?php
require_once("include/pdo.php");
$pdo = PdoGsb::getPdoGsb();

if (isset($_POST['send'])) {
    $er = 1;

    $emails = $pdo->sel_emails();
    foreach ($emails as $email) { //recherche de l'identifiant dans la base de données

        if ($email['email'] == $_POST['email']) {
            $er = 0; // identifiant trouvé
            $user = $pdo->sel_user($email['email']);

            if (password_verify($_POST['password'], $user['password'])) { // vérification du mot de passe associé à l'identifiant
                //connexion réussie, création des variables de session puis redirection vers la page d'accueil
                $_SESSION['user'] = $user['email'];
                $_SESSION['id'] = $user['id'];
                header("Location: ?controleur=stock");
            } else {
                    echo $_POST['password'];
                    echo $user['password'];
                $er=1;
            }
        }
    }
}

$vue = "vue_connexion.php";
