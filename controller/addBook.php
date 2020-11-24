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
$title = 'Ajout';

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

echo display('../view/page/addBook.html');


$view = file_get_contents('../view/footer.html');
ob_start();
eval('?>' . $view);
echo ob_get_clean();
