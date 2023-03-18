<header class="header-top" id="header">
	<div class="header">
		<?php
		if (isset($_GET['controller'])) {
			switch ($_GET['controller']) {
				case "admin_dashboard":
				case "tablet_screen":
		?>
					<div class="center">
						<span onclick="location.href='?controller=disconnection'" class="clickable color_details icon solid fa-power-off"></span>
					</div>
		<?php
					break;
			}
		}
		?>
	</div>
</header>