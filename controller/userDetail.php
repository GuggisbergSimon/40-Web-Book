<?php

/**
 * Authors : Julien Leresche & Simon Guggisberg
 * Date : 04.12.2020
 * Description : TODO
 */


include 'functions.php';
include '../model/database.php';
session_start();
$database = new Database();

//variables for MVC
$displayLoginSection = 'displayLoginSection';
$title = 'Détail Utilisateur';
$buttonTitle = 'Liste des ouvrages';
$buttonPageName = 'booksList.php';

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

if (isset($_POST["login"])) {
    login("#.php", $database->readTable("t_user"));
}
if (isset($_POST["logout"])) {
    logout("#.php");
}

//display homepage
$view = file_get_contents('../view/page/home.html');
ob_start();
eval('?>' . $view);
echo ob_get_clean();

//display main page
if (isset($_SESSION["isConnected"])) {
    echo display('../view/page/userDetail.html');
}

if (key_exists('idUser', $_GET)) {
    echo 'Name : ' . $database->getUsernameByUserId($_GET['idUser']) . '<br>';
    $books = $database->getBooksByUserId($_GET['idUser']);
    foreach ($books as $book) {
        echo $book['booTitle'] . '<br>';
    }
}

//display footer
$view = file_get_contents('../view/footer.html');
ob_start();
eval('?>' . $view);
echo ob_get_clean();
