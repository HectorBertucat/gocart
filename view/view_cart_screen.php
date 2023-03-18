<div style="margin-top:40px">
    <form method="post" action="">
        <input type="text" name="item" onblur="this.focus()" autofocus>
    </form>
</div>
<div class="half right">
    <div class="bubble" style="padding:10px;height:72px">
        <div style="width:70%" class="right">
            <h5 style="margin-top:11px;float:right;margin-right:20px;font-size:19px">
                <?php echo $_SESSION['forname'] . " " . $_SESSION['name'] ?>
            </h5>
        </div>
        <div style="width:30%">
            <a style="margin-top:7px;margin-left:20px" class="button small" onclick="location.href='?controller=cancel_basket'">Annuler le panier</a>
        </div>
    </div>
    <div class="bubble" style="height:297px">
        <h3 style="margin:0" class="color-details center"><?php echo $number_items ?> Article(s)</h3>
        <div style="background-color:green;height:2px;margin-top:10px"></div>
        <h5 style="margin:10px">Total avant remise<span style="float:right"><?php echo number_format($total_amount, 2, ".", " ") ?>€</span></h5>
        <h5 style="margin:10px">Montant remise<span style="float:right">0.00€</span></h5>
        <h5 style="margin:10px">Total H.T.<span style="float:right"><?php echo number_format($total_amount * 0.8, 2, ".", " ") ?>€</span></h5>
        <h5 style="margin:10px">Montant T.V.A.<span style="float:right"><?php echo number_format($total_amount * 0.2, 2, ".", " ") ?>€</span></h5>
        <div style="background-color:green;height:2px;margin-top:10px;margin-bottom:10px"></div>
        <h3>Total à payer<span style="float:right"><?php echo number_format($total_amount, 2, ".", " ") ?>€</span></h3>
    </div>
    <a class="button primary maxsize" onclick="location.href='?controller=basket_confirmation&amount=<?php echo $total_amount ?>&basket=<?php echo $basket[0]['id'] ?>'">Valider le paiement</a>
    <a style="margin-top:6px" class="button maxsize" onclick="location.href='?controller=assistance_confirmation'">Demande d'assistance</a>
</div>

<?php
if ($items_basket) {
?>
    <div class="half" style="overflow:auto;height:500px">

        <?php
        foreach ($items_basket as $item) {
        ?>

            <div class="tab_bubble clickable" style="height:120px;width:99%">
                <div class="right">
                    <h3 style="margin-top:35px">x<?php echo $item['quantity'] ?></h3>
                </div>
                <h5 style="margin-top:9px;margin-bottom:0"><?php echo $item['name'] ?></h5>
                <div style="background-color:green;margin-left:-10px;width:20%;height:2px;margin-top:6px;margin-bottom:5px"></div>
                <p style="margin-left:10px;margin-bottom:-5px;font-size:17px">Prix unitaire : <?php echo $item['price'] ?>€</p>
                <p style="margin-left:10px;margin-top:0;font-size:17px">Prix total : <?php echo $item['price'] * $item['quantity'] ?>€</p>

            </div>

        <?php
        }
    } else {
        ?>
        <div class="bubble half clickable" style="height:120px;opacity:10%"></div>
        <div class="bubble half clickable" style="height:120px;opacity:10%"></div>
        <div class="bubble half clickable" style="height:120px;opacity:10%"></div>
        <div class="bubble half clickable" style="height:120px;opacity:10%"></div>


    <?php
    } ?>





    </div>