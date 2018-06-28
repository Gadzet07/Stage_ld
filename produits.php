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
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script src="  https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="./js/bootstrap.js"> </script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

    <title>Produits</title>

  </head>

  <body>
    <!-- Design de la page -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="#">Inova</a> <!-- Menu principal -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="produits.php">Produits<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://example.com">Link</a>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main" class="container">
      <div class="starter-template">
        <h1>Mon stage</h1>
        <p class="lead">C'est le résultat de mon boulot pendant la durée de stage.</p>
      </div>

      <!-- Creation de la modale -->
      <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true" data-backdrop="static">
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

        <!-- Bontons servants a ajouter et supprimer des produits -->
        <input type="button" id="boutonAjouterProduit" value="Ajouter" class="btn btn-success" data-toggle="modal" data-target="#modal" onclick="modaleAjouterProduit()">
        <input type="button" id="boutonSupprimerProduit" value="Supprimer" class="btn btn-danger">

        <!-- Connection à la base de donnée -->
        <?php
          $bdd = new PDO('mysql:host=localhost;dbname=stage_ld;charset=utf8', 'root', '');
          // Selection de toute la table
          $reponse = $bdd->query('SELECT * FROM produits');
            ?>

            <!-- Affichage des produits de la base de donnée dans un tableau -->
            <table id="produits" class="table table-striped table-bordered" style="width:100%">
              <!-- Affichage statique du type d'informations -->
            <thead>
              <th>ID</th>
              <th>Nom</th>
              <th>Marque</th>
              <th>Reference</th>
              <th>Quantite</th>
              <th>Type</th>
              <th></th>
            </thead>

            <!-- Affichage de chaque information au bon endroit -->
              <tbody>
                <?php foreach ($reponse as $value) // Pour chaque donnée recuperée
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
                    <td><?php echo $value['type']; ?></td>
                    <td> <!-- Bouton qui affiche une modale avec les déclinaisons du produit séléctionné -->
                        <button onclick="modaleQuantite('<?php echo $value['id'];?>','<?php echo $value['nom'];?>','<?php echo $value['marque'];?>','<?php echo $value['reference'];?>','<?php echo $value['type'];?>')" class="btn btn-info" data-toggle="modal" data-target="#modal">
                          Afficher
                        </button>
                    </td>
                  </tr>
                <?php
                  } ?>
              </tbody>
            </table>
  </main>

  <script type="text/javascript"> // Tous les scripts
  ////////////////////////////// Gestion Produits //////////////////////////////
  // Creation d'un formulaire dans une modale pour ajouter un produit
  function modaleAjouterProduit(){
    $(".modal-title").html("Ajouter un produit"); // Titre de la modale
    $(".modal-body").empty(); // On vide la modale
    $(".modal-body").append("<p>Nom du produit: <input type='text' id='nomProduit' required></p>"); // Formulaire pour l'ajout du produit
    $(".modal-body").append("<p>Marque du produit: <input type='text' id='marqueProduit' required></p>");
    $(".modal-body").append("<p>Reference du produit: <input type='text' id='referenceProduit' autocomplete='off' required></p>");
    $(".modal-body").append("<p>Type du produit: <select id='typeProduit'> <option>soutien-gorge <option>chaussure <option>vetement</p>")
    $(".modal-body").append("<p><button onClick='ajaxAjouterProduit()'>Ajouter</button></p>"); // Bouton "ajouter" qui appelle la fonction d'ajout a la base de donnee
    }

  // Fonction qui ajoute le produit cree dans le formulaire a la base de donnees
  function ajaxAjouterProduit(){
    nomProduit=document.getElementById('nomProduit').value; // On recupere toutes les donnees necessaires a l'ajout d'un nouveau produit
    marqueProduit=document.getElementById('marqueProduit').value;
    referenceProduit=document.getElementById('referenceProduit').value;
    typeProduit=document.getElementById('typeProduit').value;
    $.ajax({
      type:"POST", // Type de transfert
      url:"ajouterProduit.php", // On transfert au fichier ajouterProduit.php
      data:{'nomProduit': nomProduit, 'marqueProduit': marqueProduit, 'referenceProduit': referenceProduit, 'typeProduit':typeProduit}, // On envoie toutes les donnees necessaires
      success: function(data){ // Si cela fonctionne
        if(data=="success") // Si le serveur a reussi a ajouter le produit
        alert("Produit ajouté avec succès!");
        else
        alert("Erreur lors de l'ajout du produit!");
      }
    })
  }

  // Fonction réalisant le tableau des produits (dataTables) + permet la selection des elements
  $(document).ready(function($) {
    var table = $('#produits').DataTable({ // On ajoute dataTables dans le tableau des produits
      "columnDefs": [ // On defini les colonnes que l'on ne veut pas afficher
              {
                  "targets": [ 0 ],
                  "visible": false,
                  "searchable": false
              },
              {
                  "targets": [ 5 ],
                  "visible": false
              }
          ]
    })

    $('#produits tbody').on( 'click', 'tr', function () {
      $(this).toggleClass('selected'); // La classe "selected" est ajoutee aux elements selectionnes

      // Fonction qui permet la suppression d'un ou plusieurs produits
      $('#boutonSupprimerProduit').click( function () {
          var tabl = [];
          if(confirm("Etes-vous sûr de vouloir supprimer ce(s) produit(s)?")){ // Alerte de confirmation de suppression
          table.rows('.selected').every(function(rowIdx) {
            tabl.push(table.row(rowIdx).data())
            })
          $.ajax({
            type:"POST",
            url:"SupprimerProduit.php",
            data:{'tabl': tabl},
            success: function(data){
              window.location.reload(); // On rafraichit la page afin de ne plus voir les elements supprimes
            }
          })
        }
      })
    })
  })

  ////////////////////////////// Gestion Declinaisons //////////////////////////////
  // Script qui permet de recuperer et d'afficher les declinaisons de la base de donnees
  function modaleQuantite(id, name, marque, reference){
    $.ajax({
      type:"POST",
      url:"details.php",
      data:"id=" + id,
      success: function(donnesRecues) {
        tableDonneesRecues = JSON.parse(donnesRecues); // On stocke les donnees recues
        $(".modal-title").html("Modification quantite " + name + " " + marque + " " + reference + "<input type='hidden' id='idProduit' value='" + id + "'>"); // Titre de la modale qui change en fonction du produit selectionne
        $(".modal-body").empty(); // On vide la modale
        $(".modal-body").html("<div id='ajouterDecliDiv' onClick='afficherFormDecli()'><input type='button' id='ajouterDecli' value='Ajouter' class='btn btn-success'></div>"); // Bouton pour afficher le formulaire d'ajout de declinaison
        $(".modal-body").append("<div id='formDeclinaison' style='display:none'><p></p><p>Couleur de la declinaison: <input type='text' id='couleurDecli' required></p><p>Bonnet de la declinaison: <input type='text' id='bonnetDecli'></p><p>Taille de la declinaison: <input type='varchar' id='tailleDecli' autocomplete='off' required></p><p>Quantite de la declinaison: <input type='number' id='quantiteDecli'</p><p><button onClick='ajaxAjouterDeclinaison()'>Ajouter</button></p></div>");
        $(".modal-body").append("<br/> <input type='button' id='boutonSupprimerDecli' value='Supprimer' class='btn btn-danger'>")
        $(".modal-body").append("<table id='decli'class='table table-striped table-bordered' style='width:100%'><thead><th>"+["ID"]+"</th><th>"+["Couleur"]+"</th><th>"+["Bonnet"]+"</th><th>"+["Taille"]+"</th><th>"+["Quantite"]+"</th><th>"+["ID-Produit"]+"</th><th></th><tbody>"); // On creer les differentes colonnes et leur nom
        numCaseQuantite = 0;
        // On parcourt le tableau et accede à l'id
        for (var i = 0; i < tableDonneesRecues.length; i++) {
                      if(tableDonneesRecues[i]["bonnet"] !== ""){ // S'il y a quelque chose dans bonnet on affiche toutes les valeurs
                        $("#decli").append("<tr><td>" +tableDonneesRecues[i]["id"]+ "</td><td>" +tableDonneesRecues[i]["couleur"]+ "</td><td>" +tableDonneesRecues[i]["bonnet"]+ "</td><td>" +tableDonneesRecues[i]["taille"]+ "</td><td><input id='quantiteProduit" +numCaseQuantite+ "' type='number' value=" +tableDonneesRecues[i]["quantite"]+ "></td><td>" +tableDonneesRecues[i]["id_produit"]+ "</td><td><button onClick='reloadQte(" +tableDonneesRecues[i]["id"]+ ", " +numCaseQuantite+ ")'>Actualiser</button></td></tr>");
                        qte=document.getElementById("quantiteProduit" +numCaseQuantite+ "").value;
                        numCaseQuantite++;
                      }else{ // S'il n'y a rien dans bonnet on affiche NA dans bonnet
                        $("#decli").append("<tr><td>" +tableDonneesRecues[i]["id"]+ "</td><td>" +tableDonneesRecues[i]["couleur"]+ "</td><td>NA</td><td>" +tableDonneesRecues[i]["taille"]+ "</td><td><input id='quantiteProduit" +numCaseQuantite+ "' type='number' value=" +tableDonneesRecues[i]["quantite"]+ "></td><td>" +tableDonneesRecues[i]["id_produit"]+"</td><td><button onClick='reloadQte(" +tableDonneesRecues[i]["id"]+ ", " +numCaseQuantite+ ")'>Actualiser</button></td></tr>");
                        qte=document.getElementById("quantiteProduit" +numCaseQuantite+ "").value;
                        numCaseQuantite++;
                      }
        }
        $(".modal-body").append("</tbody></table>"); // On ferme les balises du tableau

        $(document).ready(function($) {
        var table = $('#decli').DataTable({ // On ajoute dataTables dans le tableau des declinaisons
        "columnDefs": [ // On defini les colonnes que l'on ne veut pas afficher
                {
                    "targets": [ 0 ],
                    "visible": false,
                    "searchable": false
                },
                {
                    "targets": [ 5 ],
                    "visible": false
                }
            ]
      })

        $('#decli tbody').on( 'click', 'tr', function () {
          $(this).toggleClass('selected'); // La classe "selected" est ajoutee aux elements selectionnes

          // Fonction qui permet la suppression d'une ou plusieurs declinaisons
          $('#boutonSupprimerDecli').click( function () {
              var tabl = [];
              table.rows('.selected').every(function(rowIdx) {
                tabl.push(table.row(rowIdx).data())
                })
                if(confirm("Etes-vous sûr de vouloir supprimer cette / ces déclinaison(s)?")){ // Alerte de confirmation de suppression
              $.ajax({
                type:"POST",
                url:"SupprimerDeclinaison.php",
                data:{'tabl': tabl},
                success: function(data){
                  window.location.reload(); // On rafraichit la page afin de ne plus voir les elements supprimes
                }
              })
            }
          })
        })
      })
      }
    })
  }

  // Permet l'affichage ou non du formulaire d'ajout de declinaison
  function afficherFormDecli(){
    $("#formDeclinaison").toggle(1000); // Vitesse d'apparition du formulaire
  }

  // Fonction qui ajoute la declinaison creee dans le formulaire a la base de donnees
  function ajaxAjouterDeclinaison(){
    couleurDecli=document.getElementById('couleurDecli').value;
    bonnetDecli=document.getElementById('bonnetDecli').value;
    tailleDecli=document.getElementById('tailleDecli').value;
    quantiteDecli=document.getElementById('quantiteDecli').value;
    idProduit=document.getElementById('idProduit').value;
    $.ajax({
      type:"POST",
      url:"ajouterDeclinaison",
      data:{'couleurDecli': couleurDecli, 'bonnetDecli': bonnetDecli, 'tailleDecli': tailleDecli, 'quantiteDecli': quantiteDecli, 'idProduit': idProduit},
      success: function(data){
        if(data=="success") // Si le serveur a reussi a ajouter la declinaison
        alert("Déclinaison ajoutée avec succès!");
        else {
          alert("Erreur lors de l'ajout de la déclinaison!");
        }
      }
    })
  }

  // Fonction qui permet le changement d'une quantite d'une declinaison
  function reloadQte(id, numCaseQuantite){
    qte=document.getElementById("quantiteProduit"+numCaseQuantite+"").value;
    $.ajax({
      type:"POST",
      url:"changerQte.php",
      data:{'id': id, 'qte': qte},
      success: function(data){
        alert("Quantité changée!");
      }
    })
  }

  // Fonction qui recharge la page si on appuit sur 'echap' etant sur la modale
  $(modal).keydown(function(e) {
     if (e.keyCode == 27) { // On verifie si on appuit sur la touche echap qui a le keycode '27'
        window.location.reload();
    }
  })

  </script>

  </body>
</html>
