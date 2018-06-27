<?php
$bdd = new PDO('mysql:host=localhost;dbname=stage_ld;charset=utf8', 'root', '');
$tabl = $_POST['tabl'];

foreach ($tabl as $element){
  $result=$bdd->prepare("DELETE FROM declinaisons WHERE id = '".$element[0]."' ");
  $result->execute();
}
?>
