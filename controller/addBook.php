<?php

/**
 * Authors : Julien Leresche & Simon Guggisberg
 * Date : 02.11.2020
 * Description : Page where books are added through a form
 */

include 'functions.php';
include '../model/Database.php';
session_start();
$database = new Database();

//variables for MVC
$displayLoginSection = 'displayLoginSection';
$title = 'Ajout';
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
    login("home.php", $database->getTable("t_user"));
}
if (isset($_POST["logout"])) {
    logout("home.php");
}

//display main page
if (isset($_SESSION["isConnected"])) {
    //display form for adding a book
    $categories = $database->getTable("t_category");

    $view = file_get_contents('../view/page/addBook.html');
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
