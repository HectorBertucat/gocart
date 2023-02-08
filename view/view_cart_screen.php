<div>
    <form method="post" action="">
    <input type="text" name="item" autofocus>

    </form>

<div class="half right">
<div class="bubble" style="height:250px">
<p>Total : <?php echo $total_amount?>€</p>
<p>Nombre d'articles : <?php echo $number_items ?></p>

</div>
<a class="button maxsize" style="height:80px">Demande d'assistance</a>
<a class="button maxsize" style="height:80px">Problème de scan</a>
<a class="button primary maxsize" style="height:80px">Valider le paiement</a>



</div>
<div class="half" style="overflow:scroll;height:540px">

<?php

foreach($items_basket as $item) {
    ?>

<div class="tab_bubble clickable" style="height:120px" onclick="location.href='?controller=cart_screen&delete&id=<?php echo $item[7]?>'">
<p><?php echo $item['name'] ?> - <?php echo $item['price'] ?>€ </p> 
</div>

<?php  } ?>

 


</div>

</div>