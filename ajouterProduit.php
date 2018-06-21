<?php
$bdd = new PDO('mysql:host=localhost;dbname=stage_ld;charset=utf8', 'root', '');
$result = $bdd->prepare("INSERT INTO produits (nom, marque, reference) VALUES ('".$_POST['nomProduit']."', '".$_POST['marqueProduit']."', '".$_POST['referenceProduit']."')");
$result->execute();
?>
