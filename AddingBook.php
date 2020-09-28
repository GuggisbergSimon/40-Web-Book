<?php
include 'Database.php';
//TODO WIP
$sql = connect('localhost', 'root', 'root');
if (!authorExists($sql, $_POST['authorName'], $_POST['authorSurname'])) {
    addAuthor($sql, $_POST['authorName'], $_POST['authorSurname']);
}
if (!editorExists($sql, $_POST['editor'])) {
    addEditor($sql, $_POST['editor']);
}
if (!categoryExists($sql, $_POST['category'])) {
    addCategory($sql, $_POST['category']);
}
//TODO add book