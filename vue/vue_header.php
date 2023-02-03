<header class="header-top" id="header">
	<div class="header">
		<?php
		if (isset($_SESSION['id'])) {

		if (isset($_GET['controleur'])) {
			switch ($_GET['controleur']) {
				case "entree":
				case "sortie":
		?>
					<span onclick="location.href='?controleur=stock'" class="clickable color_details icon solid fa-check"></span>
				<?php
					break;

				case "stock":
				?>
					<span style="float:right;margin-right:20px" onclick="location.href='?controleur=deconnexion'" class="clickable color_details icon solid fa-power-off"></span>
					
				<?php
					break;

				case "parametres":
				case "article":
				case "categorie":
				case "modifier_categorie":
				case "ajout_article_stock":

				?>
					<span onclick="location.href='?controleur=stock'" class="clickable color_details icon solid fa-arrow-up"></span>
				
				
				<?php
					break;

				case "ajout_article":
				?>
					<span onclick="location.href='?controleur=entree&unk&c=<?php echo $_GET['c'] ?>'" class="clickable color_details icon solid fa-arrow-up"></span>
		<?php
			}
		}
	}
		?>
	</div>
</header>