<!doctype html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="./stage.css" rel="stylesheet">
    <link href="./css/bootstrap.css" rel="stylesheet">
    <link rel="icon" href="./autres/test.jpg">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
    <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
    <script src="  https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="./js/bootstrap.js"> </script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

    <title>Produits</title>

  </head>
  <body>
    <!-- Design de la page -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="#">Navbar</a> <!-- Menu principal -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
          </li>
          <li class="nav-item dropdown"> <!-- Bouton vers example.com + liste deroulante -->
            <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0"> <!-- Partie rechercher en haut à droite -->
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>

    <!-- < ?php require "detailsV2.php"; ?> -->

    <main role="main" class="container">
      <div class="starter-template">
        <h1>Mon stage</h1>
        <p class="lead">C'est le résultat de mon boulot pendant la durée de stage.</p>
      </div>

        <input type="button" id="ajouter" value="Ajouter">
        <input type="button" id="supprimer" value="Supprimer">

            <!-- Connection à la base de donnée -->
            <?php
              $bdd = new PDO('mysql:host=localhost;dbname=stage_ld;charset=utf8', 'root', '');
              //Selection de toute la table
              $reponse = $bdd->query('SELECT * FROM produits');
                ?>

                <!-- Affichage des produits da la base de donnée dans un tableau -->
                <table id="produits" class="table table-striped table-bordered" style="width:100%">
                  <!-- Affichage statique du type d'informations -->
                <thead>
                  <th>ID</th>
                  <th>Nom</th>
                  <th>Marque</th>
                  <th>Reference</th>
                  <th>Quantite</th>
                  <th></th>
                </thead>

                <!-- Affichage de chaque information au bon endroit -->
                  <tbody>
                    <?php foreach ($reponse as $value) //Pour chaque donnée recuperée
                      { ?>
                      <tr>
                        <!-- Affichage des différentes information -->
                        <td><?php echo $value['id']; ?></td>
                        <td><?php echo $value['nom']; ?></td>
                        <td><?php echo $value['marque']; ?></td>
                        <td><?php echo $value['reference']; ?></td>
                        <td><?php echo $value['quantite']; ?></td>
                        <!-- Bouton qui affiche un modale avec les déclinaisons du produit séléctionné -->
                        <td>
                            <button onclick="appelAjax2(<?php echo $value['id'];?>)" class="btn btn-success" data-toggle="modal" data-target="#exampleModalLong">
                              Afficher
                            </button>
                        </td>
                      </tr>
                    <?php
                      } ?>
                  </tbody>
                </table>
    </main>


<script type="text/javascript">
function appelAjax2(id){
  $.ajax({
    type:"POST",
    url:"detailsV2.php",
    data:"id=" + id,
    success: function(data) {
      console.log(data);
      
    }
  })
}
</script>

<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Détails</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">



        <table id="details" class="table table-striped table-bordered" style="width:100%">
          <!-- Affichage statique du type d'informations -->
          <thead>
            <!-- <th>id</th> -->
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


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

    <script type="text/javascript">
    // Fonction réalisant le tableau des produits (dataTables)
        $(document).ready(function($) {
            $('#produits').DataTable();
        } );

        // Fonction qui affiche l'id du produit selectionné grace a une alerte
        function appelAjax(id) {
          alert(id);
        }


    </script>
  </body>
</html>
