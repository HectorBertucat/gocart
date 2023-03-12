<?php
require_once("include/pdo.php");
$pdo = PdoGsb::getPdoGsb();

if (isset($_POST['send'])) {

    switch ($_POST['card_number']) {

        case -1 :
            header("Location: ?controller=connection");
            break;
        
            default :
            if(isset($_GET['cart']) || isset($_SESSION['cart'])) {
                $er=1; // carte manquante
            $cards = $pdo->sel_cards();
            foreach ($cards as $card) { //recherche de l'identifiant dans la base de données
        
                if ($card['card_number'] == $_POST['card_number']) {
                    $er = 0; // carte trouvée
                    $user = $pdo->sel_client($card['card_number']);
        
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['name'] = $user['name'];
                        $_SESSION['forname'] = $user['forname'];
                        $_SESSION['card_number'] = $user['card_number'];
                        $_SESSION['id_user_type'] = $user['id_user_type'];
                        $_SESSION['id'] = $user['id'];

                        if(isset($_GET['cart'])) {
                            $_SESSION['cart'] = $_GET['cart'];
                        }

                        $pdo->ins_basket($_SESSION['id'], $_SESSION['cart']);

                        $pdo->upd_state_cart($_SESSION['cart'],3);
                        header("Location: ?controller=cart_screen");

                    }
            }
            if($er==1) {
                header("Location: ?controller=error_connection_client&er=1");
            }
        } else {
            header("Location: ?controller=error_connection_client&er=2");
        
        }
    }



}
$view = "view_connection_client.php";

