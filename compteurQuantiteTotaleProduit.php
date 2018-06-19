<?
$bdd = new PDO('mysql:host=localhost;dbname=stage_ld;charset=utf8', 'root', '');
$query="SELECT SUM(quantite) FROM declinaisons WHERE id_produit= '".$value['id']."'";
$result = $bdd->query($query);
?>
