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

<div>
<div class="bubble half"></div>
<div class="bubble half right"></div>
</div>