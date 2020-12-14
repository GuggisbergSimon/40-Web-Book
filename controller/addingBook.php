<?php

/**
 * Authors : Julien Leresche & Simon Guggisberg
 * Date : 02.11.2020
 * Description : page handling various checks after a book has been added
 */

include '../model/Database.php';
session_start();

//Example of a code to create a basic user root - root for data manipulation
$servername = 'localhost';
$username = 'root';
$password = 'root';

$database = new Database();
if ($database->userExistsAt($username) < 0) {
    $database->addUser($username, $password);
    echo "created user root";
} else {
    echo "user root already existing, creation aborted";
}

$patternPictures = '/^.*\.(jpg|JPG|jpeg|JPEG|png|PNG|gif|GIF|bmp|BMP)$/';
$patternExcerpt = '/^.*\.(pdf|PDF)$/';

//ugly ass long condition but hey, if it works, it works
if (isset($_POST['title']) && !empty($_POST['title'])
    && isset($_POST['category']) && ($_POST['category'] != 'Choose')
    && isset($_POST['numberPages']) && ($_POST['numberPages'] > 0)
    && isset($_POST['authorName']) && !empty($_POST['authorName'])
    && isset($_POST['authorSurname']) && !empty($_POST['authorSurname'])
    && isset($_POST['editor']) && !empty($_POST['editor'])
    && isset($_POST['year']) && ($_POST['year'] < date("Y"))
    && isset($_POST['summary']) && !empty($_POST['summary'])
    && isset($_FILES['picture']) && preg_match($patternPictures, $_FILES['picture']["name"])
    && isset($_FILES['excerpt']) && preg_match($patternExcerpt, $_FILES['excerpt']["name"])) {

    $idAuthor = $database->authorExistsAt($_POST['authorName'], $_POST['authorSurname']);
    if ($idAuthor < 0) {
        $idAuthor = $database->addAuthor($_POST['authorName'], $_POST['authorSurname']);
    }
    $idEditor = $database->editorExistsAt($_POST['editor']);
    if ($idEditor < 0) {
        $idEditor = $database->addEditor($_POST['editor']);
    }
    $idCategory = $database->categoryExistsAt($_POST['category']);
    if ($idCategory < 0) {
        $idCategory = $database->addCategory($_POST['category']);
    }

    $sourcePic = $_FILES['picture']['tmp_name'];
    $sourceExcerpt = $_FILES['excerpt']['tmp_name'];
    $destinationPic = date("YmdHis") . $_FILES["picture"]["name"];
    $destinationExcerpt = date("YmdHis") . $_FILES["excerpt"]["name"];
    move_uploaded_file($sourcePic, "../userContent/images/" . $destinationPic);
    move_uploaded_file($sourceExcerpt, "../userContent/documents/" . $destinationExcerpt);

    $idUser = $database->userExistsAt($_SESSION['username']);
    $database->addBook($_POST['title'], $_POST['numberPages'], $destinationExcerpt, $_POST['summary'], $_POST['year'], $destinationPic, $idAuthor, $idUser, $idEditor, $idCategory);
    echo '<a href="home.php">Retour à home</a>';
} else {
    //todo put a correct header and an error message uwu
    header("Location: https://www.youtube.com/watch?v=dQw4w9WgXcQ");
}