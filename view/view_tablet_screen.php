   <h2 class="center">Demandes d'assistances en cours</h2>
   <div id="cart_list">
       <?php
        foreach ($leslignes as $ligne) { ?>
           <div class="tab_bubble">
               <h5>Chariot n°<?php echo $ligne['number'] ?></h5>
           </div>
       <?php
        }
        ?>
   </div>
