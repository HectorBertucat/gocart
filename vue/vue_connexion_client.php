<div class="bubble center">
    <form method="post" action="">
    <?php if(isset($er)){
        if($er==1){?> <p  class="color_details center">
        Numéro de carte inconnu
        </p><?php }} ?>
        <div class="row gtr-uniform">
            <div class="col-12">
                <input type="text" name="card_number" id="card_number" placeholder="N° de carte" required />
            </div>
        </div>
        <div style="display:none">
            <input type="submit" name="send" class="primary" />
        </div>
    </form>
</div> 

