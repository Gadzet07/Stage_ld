<?php
$bdd = new PDO('mysql:host=localhost;dbname=stage_ld;charset=utf8', 'root', '');
$result = $bdd->prepare("INSERT INTO declinaisons (couleur, bonnet, taille, quantite, id_produit) VALUES ('".$_POST['couleurDecli']."', '".$_POST['bonnetDecli']."', '".$_POST['tailleDecli']."', ".$_POST['quantiteDecli'].", ".$_POST['idProduit'].")");
$result->execute();
?>
