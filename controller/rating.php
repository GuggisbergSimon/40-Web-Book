<?php

/**
 * Authors : Julien Leresche & Simon Guggisberg
 * Date : 02.11.2020
 * Description : TODO
 */

include 'functions.php';
include '../model/database.php';
session_start();
$database = new Database();

//variables for MVC
$displayLoginSection = 'displayLoginSection';
$title = 'Appréciation d\'ouvrages';
$buttonTitle = 'Accueil';
$buttonPageName = 'home.php';

//display head
$view = file_get_contents('../view/head.html');
ob_start();
eval('?>' . $view);
echo ob_get_clean();

//display header
$view = file_get_contents('../view/header.html');
ob_start();
eval('?>' . $view);
echo ob_get_clean();

if(isset($_POST["login"]))
{
  login("home.php",$database->readTable("t_user"));
} 
if(isset($_POST["logout"]))
{
  logout("home.php");
}

//display homepage
$view = file_get_contents('../view/page/home.html');
ob_start();
eval('?>' . $view);
echo ob_get_clean();

?>


  <div class="album py-5 bg-light">
    <div class="container">
      <div class="row">
        <?php
          $selectedBook=$database->getBookById($_GET["idBook"]);
          echo '<div class="ratingDiv">
                  <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                      <img src="../userContent/images/' . $selectedBook["booCoverLink"] . '" alt="" width=100% height=300>
                      <div class="card-body">
                        <p class="card-text"> Titre : ' . $selectedBook["booTitle"] .'</p>
                        <p class="card-text"> Auteur : ' . findAutName($database->readTable("t_author"), $selectedBook["idAuthor"]) .'</p>
                        <p class="card-text"> Année : ' . $selectedBook["booYearEdited"] . '</p>               
                      </div>
                    </div>
                  </div>
                  <div>
                    <p><h4>Appréciation :</h4></p> 
                    <form method="post">
                      <span class="fa fa-child fa-2x checked"></span>
                      <span class="fa fa-child fa-2x checked"></span>
                      <span class="fa fa-child fa-2x"></span>
                      <span class="fa fa-child fa-2x"></span>
                      <span class="fa fa-child fa-2x"></span>
                    </form>
                  </div>
                </div>';
          
        ?>
      </div>
    </div>
  </div>

<?php
//display footer
$view = file_get_contents('../view/footer.html');
ob_start();
eval('?>' . $view);
echo ob_get_clean();
?>
