<div class="bubble center">
    <form method="post" action="">
    <?php if(isset($er)){
        if($er==1){?> <p  class="color_details center">
        Identifiant ou mot de passe incorrect
        </p><?php }} ?>
        <div class="row gtr-uniform">
            <div class="col-12">
                <input type="text" name="email" id="email" placeholder="Identifiant" required />
            </div>

            <div class="col-12">
                <input type="password" name="password" id="password" placeholder="Mot de passe" required />
            </div>

        </div>
        <div style="text-align:center;margin-top:30px;">
            <input style="width:100%" type="submit" value="Se connecter" name="send" class="primary" />
        </div>
    </form>
</div>
