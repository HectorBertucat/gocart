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

<div>
<div class="bubble half right">
    <div class="chart-container">
        <canvas id="sells_day"></canvas>
    </div>
</div>

<div class="bubble half">
    <div class="chart-container">
        <canvas id="sells_hour"></canvas>
    </div>
</div>
</div>