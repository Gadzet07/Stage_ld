<table id="details" class="table table-striped table-bordered" style="width:100%">
  <!-- Affichage statique du type d'informations -->
  <thead>
    <th>ID</th>
    <th>Couleur</th>
    <th>Bonnet</th>
    <th>Taille</th>
    <th>Quantite</th>
    <th>ID Produit</th>
  </thead>

  <tbody>
    <?php foreach($reponse as $value)
    {
      ?>
      <tr>
        <td> <?php echo $value['id']; ?> </td>
        <td> <?php echo $value['couleur']; ?> </td>
        <td> <?php echo $value['bonnet']; ?> </td>
        <td> <?php echo $value['taille']; ?> </td>
        <td> <?php echo $value['quantite']; ?> </td>
        <td> <?php echo $value['id_produit']; ?> </td>
      </tr>
    <?php
  } ?>
 </tbody>
</table>
