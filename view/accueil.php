<?php
	include_once '../controller/PanierController.php';
	include "header.php";
?>

<div>
	<a href="panier.php">Accéder à mon panier</a>
</div>
<div class="articles">
	<?php
		showItems();
		if ($_POST) {
			addPanier();
		}

	?>

</div>

<?php
	include 'footer.php';
