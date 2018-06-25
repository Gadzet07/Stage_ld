<?php
$bdd = new PDO('mysql:host=localhost;dbname=stage_ld;charset=utf8', 'root', '');
$result=$bdd->prepare("DELETE FROM produits WHERE id = ".$_POST['idProduit']."")
$result->execute();
?>
