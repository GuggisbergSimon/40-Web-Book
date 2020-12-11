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
$evaluations = $database->getEvaluationsFromBook($_GET["idBook"]);
$averageNote = computeAverageNote($evaluations);
$selectedBook = $database->getBookById($_GET["idBook"]);

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

if(isset($_POST["addRating"]))
{
  $database->addRating($_GET["idBook"], 1, $_POST["note"], $_POST["summary"]);
}

if(isset($_POST["login"]))
{
  login("rating.php?idBook=" . $_GET["idBook"],$database->readTable("t_user"));
} 
if(isset($_POST["logout"]))
{
  logout("rating.php?idBook=" . $_GET["idBook"]);
}

//display homepage
$view = file_get_contents('../view/page/home.html');
ob_start();
eval('?>' . $view);
echo ob_get_clean();

//display evaluation modal
$view = file_get_contents('../view/page/evaluationModal.html');
ob_start();
eval('?>' . $view);
echo ob_get_clean();

//display evaluation section
$view = file_get_contents('../view/page/evaluations.html');
ob_start();
eval('?>' . $view);
echo ob_get_clean();

//display footer
$view = file_get_contents('../view/footer.html');
ob_start();
eval('?>' . $view);
echo ob_get_clean();
?>
