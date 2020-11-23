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
$title = 'Accueil';

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

$findAutName = 'findAutName';
//display header
$view = file_get_contents('../view/page/home.html');
ob_start();
eval('?>' . $view);
echo ob_get_clean();
  foreach($database->readTable("t_book") as $details)
  {
      $view = file_get_contents('../view/page/bookCardModal.html');
      ob_start();
      eval('?>' . $view);
      echo ob_get_clean();
  }
?>
  <div class="album py-5 bg-light">
    <div class="container">
      <div class="row">
        <?php
            for($i=0; $i < 5;$i++) // TODO : remplacer par LIMIT 5 dans sql
            {
                $name = $database->readTable("t_book")[$i]["booCoverLink"];
                $view = file_get_contents('../view/page/bookCard.html');
                ob_start();
                eval('?>' . $view);
                echo ob_get_clean();
            }
        ?>
      </div>
    </div>
  </div>
<?php
$view = file_get_contents('../view/footer.html');
ob_start();
eval('?>' . $view);
echo ob_get_clean();