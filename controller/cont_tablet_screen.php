<?php

require_once("include/pdo.php");
$pdo = PdoGsb::getPdoGsb();

$leslignes=$pdo->sel_carts_state(4);

$view="view_tablet_screen.php";