<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="./autres/test.jpg">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
    <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
    <script src="  https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="./js/bootstrap.js"> </script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

    <title>DetailsV2</title>
  </head>
  <body>

    <!-- Button trigger modal -->
     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
      Afficher
    </button>

    <!-- Modal -->
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


            <?php
            $bdd = new PDO('mysql:host=localhost;dbname=stage_ld;charset=utf8', 'root', '');
            $reponse = $bdd->query("SELECT * FROM declinaisons WHERE id_produit = '".$_POST['choix']."' ");

            ?>
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
        $(document).ready(function($) {
            $('#details').DataTable();
        } );
    </script>

  </body>
</html>
