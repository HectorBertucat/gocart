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
                $_SESSION['email'] = $user['email'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['forname'] = $user['forname'];
                $_SESSION['card_number'] = $user['card_number'];
                $_SESSION['id_user_type'] = $user['id_user_type'];
                $_SESSION['id'] = $user['id'];

                switch($_SESSION['id_user_type']){
                    case 3:
                        header("Location: ?controller=admin_dashboard");
                        exit();
                        break;
                    case 2:
                        header("Location: ?controller=tablet_screen");
                        break;
                }
            } else {
                $er = 1;
            }
        }
    }
}

$view = "view_connection.php";
