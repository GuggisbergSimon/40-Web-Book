<?php
  include 'functions.php';
  include 'Database.php';
  session_start();
  $sql = connect("localhost","root","root");
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Bibliothèque d'ouvrages</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/album/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="album.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.checked {
  color: orange;
}
</style>
  </head>
  <body>
    <header>

  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container d-flex justify-content-between">
      <a href="#" class="navbar-brand d-flex align-items-center">
        <strong><h1>Liste des ouvrages</h1></strong>
      </a>
      <form>
        <div class="form-group" >
          <input type="text" class="form-control" id="username" aria-describedby="userHelp" placeholder="Username">
        </div>
        <div class="form-group">
          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
      </form>
    </div>
  </div>
</header>

<main role="main">

  <section class="jumbotron text-center">
    <div class="container">
      <h1>Bibliothèque en ligne</h1>
      <p class="lead text-muted">Ce site répertorie des oeuvres littéraires de tous les horizons, des lecteurs passionés et avides de bouquins, ainsi que leurs appréciations.</p>
      <p>
        <a href="home.php" class="btn btn-primary my-2">Accueil</a>
        <a href="AddBook.php" class="btn btn-secondary my-2">Ajouter un ouvrage</a>
      </p>
    </div>
  </section>
<?php

  foreach(readTable($sql,"t_book") as $details)
  {
    echo '<div class="modal fade" id="id'. $details["idBook"] .'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Détails</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <img src="../images/' . $details["booCoverLink"] . '" alt="" width=100% height=300 >
                  <p class="card-text"> <strong>Titre</strong> : ' . $details["booTitle"] .'</p>
                  <p class="card-text"> <strong>Auteur</strong> : ' . findAutName(readTable($sql,"t_author"),$details["idAuthor"]) . '</p>
                  <p class="card-text"> <strong>Année</strong> : ' . $details["booYearEdited"] . '</p>
                  <p class="card-text"> <strong>Nombre de pages</strong> : ' . $details["booNbrPages"] . '</p>
                  <p class="card-text"> <strong>Résumé</strong> : ' . $details["booSummary"] . '</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>';
  }
?>
  <div class="album py-5 bg-light">
    <div class="container">
      <div class="row">
        <?php
          foreach(readTable($sql,"t_book") as $details)
          {
            $name = $details["idBook"] . ".jpg";
            echo '<div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                      <img src="../images/' . $details["booCoverLink"]. '" alt="" width=100% height=300>
                      <div class="card-body">
                        <p class="card-text"> <strong>Titre</strong> : ' . $details["booTitle"] .'</p>
                        <p class="card-text"> <strong>Auteur</strong> : ' . findAutName(readTable($sql,"t_author"),$details["idAuthor"]) .'</p>
                        <p class="card-text"> <strong>Année</strong> : ' . $details["booYearEdited"] . '</p>
                        <div class="d-flex justify-content-between align-items-center">
                          <div class="btn-group">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#id' . $details["idBook"] . '">Details</button>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#evaluation">Évaluer</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>';
          }
        ?>
      </div>
    </div>
  </div>

</main>

</footer class="text-muted">
  <div class="container">
    <p class="float-right">
      <a href="#">Back to top</a>
    </p>
  </div>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>
