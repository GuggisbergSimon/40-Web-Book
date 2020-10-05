<?php
include 'Database.php';

//Example of a code to create a basic user root - root for data manipulation
/** @var string $servername */
$servername = 'localhost';
/** @var string $username */
$username = 'root';
/** @var string $password */
$password = 'root';

$sql = connect($servername, $username, $password);
if (userExistsAt($sql, $username) > 0) {
    addUser($sql, $username, $password);
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

    $sql = connect('localhost', 'root', 'root');

    $idAuthor = authorExistsAt($sql, $_POST['authorName'], $_POST['authorSurname']);
    if ($idAuthor < 0) {
        $idAuthor = addAuthor($sql, $_POST['authorName'], $_POST['authorSurname']);
    }
    $idEditor = editorExistsAt($sql, $_POST['editor']);
    if ($idEditor < 0) {
        $idEditor = addEditor($sql, $_POST['editor']);
    }
    $idCategory = categoryExistsAt($sql, $_POST['category']);
    if ($idCategory < 0) {
        $idCategory = addCategory($sql, $_POST['category']);
    }

    $sourcePic = $_FILES['picture']['tmp_name'];
    $sourceExcerpt = $_FILES['excerpt']['tmp_name'];
    $destinationPic = "Images/" . date("YmdHis") . $_FILES["picture"]["name"];
    $destinationExcerpt = "Documents/" . date("YmdHis") . $_FILES["excerpt"]["name"];
    move_uploaded_file($sourcePic, $destinationPic);
    move_uploaded_file($sourceExcerpt, $destinationExcerpt);

    //todo add id user properly
    addBook($sql, htmlspecialchars($_POST['title']), $_POST['numberPages'], htmlspecialchars($destinationExcerpt), htmlspecialchars($_POST['summary']), $_POST['year'], htmlspecialchars($destinationPic), $idAuthor, 0, $idEditor, $idCategory);

} else {
    echo "something wrong happened please go back";
    echo "failed";
}
