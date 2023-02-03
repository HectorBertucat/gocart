<!DOCTYPE HTML>
<html>

<head>
    <title>Gocart</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="icon" href="image/icon.png" />
    <noscript>
        <link rel="stylesheet" href="css/noscript.css" />
    </noscript>

    <link rel="stylesheet" href="css/main.css" />
</head>

<body>



    <div id="wrapper">
        <div id="main">
            <div class="inner">

                <?php

                include "vue/vue_header.php";

                include "vue/" . $vue;
                ?>
            </div>
        </div>
    </div>
    <div id="scrollUp">
        <a href="#top"><img style="width:50px;" src="image/to-top.png" /></a>
    </div>
</body>
<?php
include "vue/vue_script.php";
?>

</html>