<?php
require_once("include/pdo.php");
$pdo = PdoGsb::getPdoGsb();

if (isset($_POST['send'])) {

    switch ($_POST['card_number']) {

        case -1 :
            header("Location: ?controller=connection");
            break;
        
            default :
            $er = 1;

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
                        $_SESSION['cart'] = $_POST['id_cart'];

                        $pdo->ins_basket($_SESSION['id'], $_SESSION['cart']);

                        header("Location: ?controller=cart_screen");

                    } else {
                        $er = 1;
                }
            }
    }


}
$view = "view_connection_client.php";

