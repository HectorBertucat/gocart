<div style="margin-top:15%;" class="center">
    <img class="logo_gocart" src="image/logo.png">
</div>
<div class="bubble center" style="height:310px;width:50%;margin-left:25%;margin-top:40px">
    <form method="post" action="">
        <?php
        if (isset($er)) {
            if ($er == 1) {
        ?>
                <p class="color_details center">Identifiant ou mot de passe incorrect</p>
        <?php
            }
        }
        ?>
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