<?php
$bdd = new PDO('mysql:host=localhost;dbname=stage_ld;charset=utf8', 'root', '');
$reponse = $bdd->query("SELECT * FROM declinaisons WHERE id_produit = '".$_POST['id']."' ");
$res = $reponse->fetchAll();
echo json_encode($res);

$reponse->closeCursor();
?>
