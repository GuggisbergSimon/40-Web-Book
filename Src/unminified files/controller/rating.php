<?php

/**
 * Authors : Julien Leresche & Simon Guggisberg
 * Date : 16.11.2020
 * Description : Page where users add a rating to a book
 */

include_once 'functions.php';
include_once '../model/Database.php';
session_start();
$database = new Database();

//evaluations and average note from the current book
$selectedEvaluations = $database->getSomeEvaluationsFromBook($_GET["idBook"]);
$evaluations = $database->getAllEvaluationsFromBook($_GET["idBook"]);
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

//check if login/logout functions should be call
if (isset($_POST["login"])) {
    login("rating.php?idBook=" . $_GET["idBook"], $database->getTable("t_user"));
}
if (isset($_POST["logout"])) {
    logout("rating.php?idBook=" . $_GET["idBook"]);
}

if (isset($_SESSION['isConnected'])) {
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

    //display evaluations list modal
    $view = file_get_contents('../view/page/evaluationsListModal.html');
    ob_start();
    eval('?>' . $view);
    echo ob_get_clean();

    //display evaluation section
    $view = file_get_contents('../view/page/evaluations.html');
    ob_start();
    eval('?>' . $view);
    echo ob_get_clean();
} else {
    //display forbidden access message
    $view = file_get_contents('../view/page/forbiddenAccessMessage.html');
    ob_start();
    eval('?>' . $view);
    echo ob_get_clean();
}

//display footer
$view = file_get_contents('../view/footer.html');
ob_start();
eval('?>' . $view);
echo ob_get_clean();
unset($database);
