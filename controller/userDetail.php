<?php

/**
 * Authors : Julien Leresche & Simon Guggisberg
 * Date : 04.12.2020
 * Description : Page showing all the books a user has added
 */

include 'functions.php';
include '../model/Database.php';
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

//check if login/logout functions should be call
if (isset($_POST["login"])) {
    login("home.php", $database->getTable("t_user"));
}
if (isset($_POST["logout"])) {
    logout("home.php");
}

if(isset($_SESSION['isConnected']))
{
    //display homepage
    $view = file_get_contents('../view/page/home.html');
    ob_start();
    eval('?>' . $view);
    echo ob_get_clean();

    //display the list of books added by the user
    if (key_exists('idUser', $_GET)) {
        echo '<div class="container"><br>
                    <h4>Utilisateur : ' . $database->getUsernameByUserId($_GET['idUser']) . '</h4>
                    <h6>Livres ajoutés à la base de données par cette bonne âme</h6>
                    <ul>';
        $books = $database->getBooksByUserId($_GET['idUser']);
        foreach ($books as $book) {
            echo '<li>' . $book['booTitle'] . '</li>';
        }
        echo '</ul><br></div>';
    }
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
