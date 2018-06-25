<!doctype html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="./stage.css" rel="stylesheet">
    <link href="./css/bootstrap.css" rel="stylesheet">
    <link rel="icon" href="./autres/test.jpg">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
    <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
    <!-- <link href="https://cdn.datatables.net/1.10.18/css/jquery.dataTables.min.css"> -->
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script src="  https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="./js/bootstrap.js"> </script>
    <!-- <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script> -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
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

    <main role="main" class="container">
      <div class="starter-template">
        <h1>Mon stage</h1>
        <p class="lead">C'est le résultat de mon boulot pendant la durée de stage.</p>
      </div>

      <!-- Creation de la modale -->
      <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true" data-backdrop="static"> <!-- data-keyboard="false" -->
        <div class="modal-dialog" id="modalDialog" role="document">
          <div class="modal-content" id="modalContent">
            <div class="modal-header">
              <h5 class="modal-title" id="modalTitle"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload();"> <!-- Un clic sur le bouton fermer recharge la page "Produits"-->
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            </div>

            <!-- Bouton fermer en bas de la modale -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload();">Close</button>
            </div>
          </div>
        </div>
      </div>

        <input type="button" id="boutonAjouterProduit" value="Ajouter" class="btn btn-success" data-toggle="modal" data-target="#modal" onclick="modaleAjouterProduit()">
        <input type="button" id="boutonSupprimerProduit" value="Supprimer" class="btn btn-danger" onclick="supprimerProduit()">

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
                    <td><?php $query=("SELECT SUM(quantite) FROM declinaisons WHERE id_produit= '".$value['id']."'"); // On recupere la somme des quantites de toutes les declinaisons
                      $result = $bdd->query($query);
                      $quantite =$result->fetch();
                      if ($quantite[0] > 0) // On verifie s'il y a du stock
                        echo $quantite[0]; // On l'affiche s'il y en a
                        else
                        echo "Stock vide!"; // Sinon on affiche "Stock vide!"
                        ?>
                    </td>
                      <!-- Bouton qui affiche une modale avec les déclinaisons du produit séléctionné -->
                    <td>
                        <button onclick="modaleQuantite(<?php echo $value['id'];?>,'<?php echo $value['nom'];?>','<?php echo $value['marque'];?>','<?php echo $value['reference'];?>')" class="btn btn-success" data-toggle="modal" data-target="#modal">
                          Afficher
                        </button>
                    </td>
                  </tr>
                <?php
                  } ?>
              </tbody>
            </table>

  </main>
  <!-- script javascript qui permet d'aller chercher les declinaisons dans la base de donnees -->
  <script type="text/javascript">
  function modaleQuantite(id, name, marque, reference){
    $.ajax({
      type:"POST", // type de transfert
      url:"detailsV2.php", // on transfert au fichier detailsV2.php
      data:"id=" + id, // on envoie l'id
      success: function(donnesRecues) { //si cela fonctionne
        tableDonneesRecues = JSON.parse(donnesRecues); // on stocke les donnees recues
        $(".modal-title").html("Modification quantite " + name + " " + marque + " " + reference + "<input type='hidden' id='idProduit' value='" + id + "'>");
        $(".modal-body").empty(); // on vide la modale
        $(".modal-body").html("<div id='ajouterDecliDiv' onClick='afficherFormDecli()'><input type='button' id='ajouterDecli' value='Ajouter' class='btn btn-success'></div>"); // bouton pour afficher le formulaire d'ajout de declinaison
        $(".modal-body").append("<div id='formDeclinaison' style='display:none'><p>Couleur de la declinaison:<input type='text' id='couleurDecli' required></p><p>Bonnet de la declinaison:<input type='text' id='bonnetDecli'></p><p>Taille de la declinaison:<input type='varchar' id='tailleDecli' autocomplete='off' required></p><p>Quantite de la declinaison:<input type='int' id='quantiteDecli'</p><p><button onClick='ajaxAjouterDeclinaison()'>Ajouter</button></p></div>");
        $(".modal-body").append("<table id='decli'class='table table-striped table-bordered' style='width:100%'><thead><th>"+["ID"]+"</th><th>"+["Couleur"]+"</th><th>"+["Bonnet"]+"</th><th>"+["Taille"]+"</th><th>"+["Quantite"]+"</th><th>"+["ID-Produit"]+"</th><th></th><tbody>"); // on creer les differentes colonnes et leur nom
        numCaseQuantite = 0;
        // Parcourt tableau, accede à id
        for (var i = 0; i < tableDonneesRecues.length; i++) {
                      if(tableDonneesRecues[i]["bonnet"] !== ""){ // s'il y a quelque chose dans bonnet on affiche toutes les valeurs
                        $("#decli").append("<tr><td>" +tableDonneesRecues[i]["id"]+ "</td><td>" +tableDonneesRecues[i]["couleur"]+ "</td><td>" +tableDonneesRecues[i]["bonnet"]+ "</td><td>" +tableDonneesRecues[i]["taille"]+ "</td><td><input id='quantiteProduit" +numCaseQuantite+ "' type='number' value=" +tableDonneesRecues[i]["quantite"]+ "></td><td>" +tableDonneesRecues[i]["id_produit"]+ "</td><td><button onClick='reloadQte(" +tableDonneesRecues[i]["id"]+ ", " +numCaseQuantite+ ")'>Actualiser</button></td></tr>");
                        qte=document.getElementById("quantiteProduit" +numCaseQuantite+ "").value;
                        numCaseQuantite++;
                      }else{ // s'il n'y a rien dans bonnet on affiche tout ormis la colonne bonnet
                        $("#decli").append("<tr><td>" +tableDonneesRecues[i]["id"]+ "</td><td>" +tableDonneesRecues[i]["couleur"]+ "</td><td>NA</td><td>" +tableDonneesRecues[i]["taille"]+ "</td><td><input id='quantiteProduit" +numCaseQuantite+ "' type='number' value=" +tableDonneesRecues[i]["quantite"]+ "></td><td>" +tableDonneesRecues[i]["id_produit"]+"</td><td><button onClick='reloadQte(" +tableDonneesRecues[i]["id"]+ ", " +numCaseQuantite+ ")'>Actualiser</button></td></tr>");
                        qte=document.getElementById("quantiteProduit" +numCaseQuantite+ "").value;
                        numCaseQuantite++;
                      }
        }
        $(".modal-body").append("</tbody></table>"); // on ferme les balises du tableau
        $('#decli').DataTable(); // on ajoute dataTables dans le tableau des declinaisons
      }
    })
  }

  // Permet l'affichage ou non du formulaire d'ajout de declinaison
  function afficherFormDecli(){
    $("#formDeclinaison").toggle(1000);
  }

  // Fonction qui permet le changement d'une quantite d'une declinaison
  function reloadQte(id, numCaseQuantite){
    qte=document.getElementById("quantiteProduit"+numCaseQuantite+"").value;
    $.ajax({
      type:"POST",
      url:"changerQte.php",
      data:{'id': id, 'qte': qte},
      success: function(data){
      }
    })

  }
  ////////////////////////////// Gestion Produits //////////////////////////////
  // Creation d'un formulaire dans une modale pour ajouter un produit
  function modaleAjouterProduit(){
    $(".modal-title").html("Ajouter un produit");
    $(".modal-body").empty();
    $(".modal-body").append("<p>Nom du produit:<input type='text' id='nomProduit' required></p>");
    $(".modal-body").append("<p>Marque du produit:<input type='text' id='marqueProduit' required></p>");
    $(".modal-body").append("<p>Reference du produit:<input type='text' id='referenceProduit' autocomplete='off' required></p>");
    $(".modal-body").append("<button onClick='ajaxAjouterProduit()'>Ajouter</button>");
    }

  // Fonction qui ajoute le produit cree dans le formulaire a la base de donnees
  function ajaxAjouterProduit(){
    nomProduit=document.getElementById('nomProduit').value
    marqueProduit=document.getElementById('marqueProduit').value
    referenceProduit=document.getElementById('referenceProduit').value
    $.ajax({
      type:"POST",
      url:"ajouterProduit.php",
      data:{'nomProduit': nomProduit, 'marqueProduit': marqueProduit, 'referenceProduit': referenceProduit},
      success: function(data){
        alert("Produit ajouté avec succès!");
      }
    })
  }

  // Fonction qui permet la suppression d'un ou plusieurs produits
  function supprimerProduit(){
    // $.ajax({
    //   type:"POST",
    //   url:"supprimerProduit.php"
    //   data:{'idProduit':idProduit}
    // })
    <?php foreach ($.selected as $selected => $selected): ?>

    <?php endforeach; ?>
  }

  ////////////////////////////// Gestion Declinaisons //////////////////////////////
  // Fonction qui ajoute la declinaison creee dans le formulaire a la base de donnees
  function ajaxAjouterDeclinaison(){
    couleurDecli=document.getElementById('couleurDecli').value;
    bonnetDecli=document.getElementById('bonnetDecli').value;
    tailleDecli=document.getElementById('tailleDecli').value;
    quantiteDecli=document.getElementById('quantiteDecli').value;
    idProduit=document.getElementById('idProduit').value;
    $.ajax({
      type:"POST",
      url:"ajouterDeclinaison.php",
      data:{'couleurDecli': couleurDecli, 'bonnetDecli': bonnetDecli, 'tailleDecli': tailleDecli, 'quantiteDecli': quantiteDecli, 'idProduit': idProduit},
      success: function(data){
        alert("Déclinaison ajoutée avec succès!");
      }
    })
  }

  // Fonction qui permet la suppression d'une ou plusieurs declinaisons
  function supprimerDeclinaison(){
  }

  // Fonction réalisant le tableau des produits (dataTables)
  $(document).ready(function($) {
      $('#produits').DataTable();

      $('#produits tbody').on( 'click', 'tr', function () {
          $(this).toggleClass('selected');
      } );

      $('#boutonSupprimerProduit').click( function () {
          alert( ' row(s) selected' );
      } );
    });

    // Fonction qui recharge la page si on appuit sur 'echap' etant sur la modale
    $(modal).keydown(function(e) {
       if (e.keyCode == 27) { // On verifie si on appuit sur la touche echap qui a le keycode '27'
          window.location.reload();
      }
  });

//////////////////////// Selection des lignes et compteurs de lignes selectionnees ----- Peut etre utile pour la suppression ////////////////////////
//  $(document).ready(function() {
//     var table = $('#produits').DataTable();
//
//     $('#produits tbody').on( 'click', 'tr', function () {
//         $(this).toggleClass('selected');
//     } );
//
//     $('#button').click( function () {
//         alert( table.rows('.selected').data().length +' row(s) selected' );
//     } );
// } );
  </script>

  </body>
</html>
