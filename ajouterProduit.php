<?php
$bdd = new PDO('mysql:host=localhost;dbname=stage_ld;charset=utf8', 'root', '');
if(empty($_POST['nomProduit']) or empty($_POST['marqueProduit']) or empty($_POST['referenceProduit']) or empty($_POST['typeProduit']))
echo "error";
else{
  $result = $bdd->prepare("INSERT INTO produits (nom, marque, reference, type) VALUES ('".$_POST['nomProduit']."', '".$_POST['marqueProduit']."', '".$_POST['referenceProduit']."', '".$_POST['typeProduit']."')");
  $result->execute();
  echo "success";
}
?>
