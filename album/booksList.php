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

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="album.css" rel="stylesheet">
  </head>
  <body>
    <header>
  <div class="collapse bg-dark" id="navbarHeader">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-md-7 py-4">
          <h4 class="text-white">About</h4>
          <p class="text-muted">Add some information about the album below, the author, or any other background context. Make it a few sentences long so folks can pick up some informative tidbits. Then, link them off to some social networking sites or contact information.</p>
        </div>
        <div class="col-sm-4 offset-md-1 py-4">
          <h4 class="text-white">Contact</h4>
          <ul class="list-unstyled">
            <li><a href="#" class="text-white">Follow on Twitter</a></li>
            <li><a href="#" class="text-white">Like on Facebook</a></li>
            <li><a href="#" class="text-white">Email me</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container d-flex justify-content-between">
      <a href="#" class="navbar-brand d-flex align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="mr-2" viewBox="0 0 24 24" focusable="false"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
        <strong>EZBooks</strong>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </div>
</header>

<main role="main">

  <section class="jumbotron text-center">
    <div class="container">
      <h1>Bibliothèque en ligne</h1>
      <p class="lead text-muted">Ce site répertorie des oeuvres littéraires de tous les horizons, des lecteurs passionés et avides de bouquins, ainsi que leurs appréciations.</p>
      <p>
        <a href="#" class="btn btn-primary my-2">Accueil</a>
        <a href="#" class="btn btn-secondary my-2">Ajouter un ouvrage</a>
      </p>
    </div>
  </section>
<?php
  include 'functions.php';
  $informationBooks = array();
  $informationAuthors = array();
  $idPrefix="id";

  try {
    $con= new PDO('mysql:host=localhost;dbname=book', "root", "root");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $queryBook = "SELECT * FROM t_book";
    $dataBook = $con->query($queryBook);
    $dataBook->setFetchMode(PDO::FETCH_ASSOC);
    $queryAuthor = "SELECT * FROM t_author";
    $dataAuthor = $con->query($queryAuthor);
    $dataAuthor->setFetchMode(PDO::FETCH_ASSOC);
  } catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
  }

  foreach($dataBook as $details)
  {
    $informationBooks[] = $details;
  }
  foreach($dataAuthor as $details)
  {
    $informationAuthors[] = $details;
  }

  foreach($informationBooks as $details)
  {
    $name = "id" . $details["idBook"] . ".jpg";
    echo '<div class="modal fade" id="'. ($idPrefix . $details["idBook"]) .'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Détails</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <img src="../Images/' . $name . '" alt="" width=100% height=300>
                  <p class="card-text"> Titre : ' . $details["booTitle"] .'</p>
                  <p class="card-text"> Auteur : ' . findAutName($informationAuthors,$details["idAuthor"]) . '</p>
                  <p class="card-text"> Année : ' . $details["booYearEdited"] . '</p>
                  <p class="card-text"> Nombre de pages : ' . $details["booNbrPages"] . '</p>
                  <p class="card-text"> Résumé : ' . $details["booSummary"] . '</p>
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
          foreach($informationBooks as $details)
          {
            $name = "id" . $details["idBook"] . ".jpg";
            echo '<div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                      <img src="../Images/' . $name . '" alt="" width=100% height=300>
                      <div class="card-body">
                        <p class="card-text"> Titre : ' . $details["booTitle"] .'</p>
                        <p class="card-text"> Auteur : ' . findAutName($informationAuthors,$details["idAuthor"]) .'</p>
                        <p class="card-text"> Année : ' . $details["booYearEdited"] . '</p>
                        <div class="d-flex justify-content-between align-items-center">
                          <div class="btn-group">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#' . ($idPrefix . $details["idBook"]) . '">Details ouvrage</button>
                          </div>
                          <small class="text-muted">9 mins</small>
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
    <p>Album example is &copy; Bootstrap, but please download and customize it for yourself!</p>
    <p>New to Bootstrap? <a href="https://getbootstrap.com/">Visit the homepage</a> or read our <a href="../getting-started/introduction/">getting started guide</a>.</p>
  </div>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</html>
