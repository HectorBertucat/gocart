<div class="bubble">
<p>

<?php

echo 
$_SESSION['name'] . " " .
$_SESSION['forname'] . " - " .
$_SESSION['email'] . " | carte n°" .
$_SESSION['card_number'] . " - Acréditation : " .
$_SESSION['id_user_type'] . " - Identifiant : " .
$_SESSION['id'];

?>

</p></div>

<input id="datepicker" type="date">

<select name="article_type" id="article_type">
    <option value="0">Tous les articles</option>
    <?php foreach($article_type as $type) { ?>
        <option value="<?php echo $type['id'] ?>"><?php echo $type['name'] ?></option>
    <?php } ?>
</select>

<select name="carts" id="carts">
    <option value="0">Tous les chariots</option>
    <?php foreach($carts as $cart) { ?>
        <option value="<?php echo $cart['id'] ?>"> Chariot n°<?php echo $cart['id'] ?></option>
    <?php } ?>
</select>

<div>
<div class="bubble half right">
    <div class="chart-container">
        <canvas id="sells_day_amount"></canvas>
    </div>
    <hr>
    <div class="chart-container">
        <canvas id="sells_day_quantity"></canvas>
    </div>
</div>

<div class="bubble half">
    <div class="chart-container">
        <canvas id="sells_hour_amount"></canvas>
    </div>
    <hr>
    <div class="chart-container">
        <canvas id="sells_hour_quantity"></canvas>
    </div>
</div>

    <hr>

<input id="datepickerTurnoverStart" type="date">
<input id="datepickerTurnoverEnd" type="date">

    <div>
        <div class="bubble half right">
            <p>CA</p>
            <p id="turnover"></p>
        </div>
        <div class="bubble half"
            <p>Nombre de chariot : </p>
            <select name="cartStatus" id="cartStatus">
                <?php foreach($cartStatus as $status) { ?>
                    <option value="<?php echo $status['id'] ?>"><?php echo $status['name'] ?></option>
                <?php } ?>
            </select>
            <p id="nbCarts"></p>
        </div>
    </div>

</div>