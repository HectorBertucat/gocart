<div style="margin-top:15%;" class="center">
    <img class="logo_gocart" src="image/logo.png">
</div>
<div class="bubble center" style="height:250px;width:50%;margin-left:25%;margin-top:40px">
    <h5>Confirmez-vous le contenu du panier ?</h5>
    <a style="width:100%" class="button primary" onclick="location.href='?controller=basket_confirmation&basket=<?php echo $_GET['basket'] ?>&amount=<?php echo $_GET['amount'] ?>&confirm'">Confirmer</a>
    <a style="width:100%" class="button" onclick="location.href='?controller=cart_screen'">Retour au panier</a>
</div>