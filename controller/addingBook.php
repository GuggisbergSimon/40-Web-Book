<?php

/**
 * Authors : Julien Leresche & Simon Guggisberg
 * Date : 02.11.2020
 * Description : page handling various checks after a book has been added
 */

include '../model/Database.php';
session_start();

//Example of a code to create a basic user root - root for data manipulation

$database = new Database();
$patternPictures = '/^.*\.(jpg|JPG|jpeg|JPEG|png|PNG|gif|GIF|bmp|BMP)$/';
$patternExcerpt = '/^.*\.(pdf|PDF)$/';

// Conditions
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
    $destinationPic = date("YmdHis") . substr($_FILES["picture"]["name"], 0, 3);
    $destinationExcerpt = date("YmdHis") . substr($_FILES["excerpt"]["name"], 0, 3);
    move_uploaded_file($sourcePic, "../userContent/images/" . $destinationPic);
    move_uploaded_file($sourceExcerpt, "../userContent/documents/" . $destinationExcerpt);

    $idUser = $database->userExistsAt($_SESSION['username']);
    $database->addBook($_POST['title'], $_POST['numberPages'], $destinationExcerpt, $_POST['summary'], $_POST['year'], $destinationPic, $idAuthor, $idUser, $idEditor, $idCategory);

    header("Location: home.php");
} else {

    header("Location: addBook.php");
}