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
					<span class="icon solid fa-plus color_details clickable" onclick="location.href='?controleur=ajout_article_stock'"></span>

					<span style="float:left;margin-left:20px" class="icon solid fa-download color_details clickable" onclick="location.href='?controleur=download_stock<?php if(isset($_POST['recherche'])){ ?>&recherche=<?php echo $_POST['recherche']; } if(isset($_GET['categorie'])){?>&categorie=<?php echo $_GET['categorie']; } ?>'"></span>

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