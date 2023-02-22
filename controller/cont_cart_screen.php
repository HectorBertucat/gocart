<?php
require_once("include/pdo.php");
$pdo = PdoGsb::getPdoGsb();


$basket= $pdo->sel_basket($_SESSION['cart'], $_SESSION['id']);

$items_basket= $pdo->sel_items_basket($basket[0]['id']);

$total_amount=0;
$number_items=0;

foreach($items_basket as $item) {
    $total_amount += $item['price']*$item['quantity'];
    $number_items += 1*$item['quantity'];
}

if(isset($_POST['item'])) {

    if(strlen($_POST['item']) != 14) { //Longueur de la chaine
        $error = 1; // Erreur longueur chaine
        header("Location: ?controller=cart_screen");
    }


    $scan_item = $pdo->sel_item(substr($_POST['item'], 1)); 

    if($scan_item) { // L'item existe dans la bdd
        $exist = false;

    switch(substr($_POST['item'], 0, 1)){ // Entrée ou sortie ?

        case "i":
        foreach($items_basket as $item) { // L'item existe dans le panier ?
            if($item['id_item'] == $scan_item['id']) {
                $exist = true;
            }
        }
    
        if($exist) {
            $pdo->upd_qte_item_in_basket($scan_item['id'], $basket[0]['id'],1);
        } else {
            $pdo->ins_item_in_basket($scan_item['id'], $basket[0]['id']);
        }
            break;

        case "o":
            $exist = false;
        foreach($items_basket as $item) { // L'item existe dans le panier ?
            $exist=true;
        }

        if($exist) {
            $removed = $pdo->sel_item_basket($scan_item['id'], $basket[0]['id']);

            if($removed['quantity'] < 2) {
             $pdo->del_item_basket($scan_item['id'], $basket[0]['id']);
            } else {
                $pdo->upd_qte_item_in_basket($scan_item['id'], $basket[0]['id'],-1);

               
            }
            
        } else {
            $error = 3; // L'item sorti n'existe pas dans le panier
        }
            break;
        
        default:
    }

   header("Location: ?controller=cart_screen");
        
    } else {
        $error = 2; // Erreur item inconnu
    }

}

$view = "view_cart_screen.php";
