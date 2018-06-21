<?php
$bdd = new PDO('mysql:host=localhost;dbname=stage_ld;charset=utf8', 'root', '');
$query="UPDATE declinaisons SET quantite = '".$_POST['qte']."' WHERE id = '".$_POST['id']."'";
$result = $bdd->query($query);
?>
