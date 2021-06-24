<?php
include_once '../controller/PanierController.php';
include 'header.php';
?>

    <h1>Mon panier</h1>
<div class="lien">
    <a href="accueil.php">Retour à la page d'accueil</a>
    <a class="vider" href="panier.php?vider=O">Vider le panier</a>
</div>
    <div class="display">
        <div class="articles">
    <?php
		showPanier();
		if(isset($_GET['vider']) == 'O') {
			viderPanier();
		}
		foreach($_GET as $key => $value) {
			$url = $key;
			deletePanier();
		}



    ?>
</div>

<?php include 'footer.php';
