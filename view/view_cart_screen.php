<div>
    <form method="post" action="">
    <input type="text" name="item" onblur="this.focus()" autofocus>

    </form>

<div class="half right">
<div class="bubble" style="height:250px">
<p>Nombre d'articles : <?php echo $number_items ?></p>
<p>Total : <?php echo $total_amount?>€</p>

</div>
<a class="button maxsize" onclick="location.href='?controller=assistance_request'" style="height:80px">Demande d'assistance</a>
<a class="button primary maxsize" style="height:80px" onclick="location.href='?controller=basket_confirmation&amount=<?php echo $total_amount ?>&basket=<?php echo $basket[0]['id']?>'">Valider le paiement</a>
<a class="button maxsize" onclick="location.href='?controller=cancel_basket'">Annuler le panier</a>

</div>
<div class="half" style="overflow:scroll;height:540px">

<?php

foreach($items_basket as $item) {
    ?>

<div class="tab_bubble clickable" style="height:120px">
<p><?php echo $item['name'] ?> - <?php echo $item['price'] ?>€ - x<?php echo $item['quantity']?></p> 
</div>

<?php  } ?>

 


</div>

</div>