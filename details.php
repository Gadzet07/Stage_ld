<?php
$bdd = new PDO('mysql:host=localhost;dbname=stage_ld;charset=utf8', 'root', '');
$reponse = $bdd->query("SELECT * FROM declinaisons WHERE id_produit = '".$_POST['id']."' ");
echo json_encode($reponse->fetchAll());
$reponse->closeCursor();
?>
