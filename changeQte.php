<?php
$bdd = new PDO('mysql:host=localhost;dbname=stage_ld;charset=utf8', 'root', '');
$query="UPDATE declinaisons SET quantite = '".$_POST['qt']."' WHERE id = '".$_POST['id']."'";
$result = $bdd->query($query);
echo qt;
?>
