<h2 class="center">Demandes d'assistances en cours (<span id="nb_carts" class="color_details"><?php echo count($leslignes) ?></span>)</h2>
<div>
    <div id="cart_list" class="cart_list">
        <?php
        foreach ($leslignes as $ligne) {
        ?>
            <div style="position:absolute;margin-left:<?php echo $ligne['x'] ?>%;margin-top:<?php echo $ligne['y'] ?>%">
                <div class="cart_dot"></div>
            </div>
        <?php
        }
        ?>
    </div>
</div>