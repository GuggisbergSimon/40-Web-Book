<?php

/**
 * Authors : Julien Leresche & Simon Guggisberg
 * Date : 16.11.2020
 * Description : page handling various checks after a rating has been added
 */

include '../model/Database.php';
include 'functions.php';
$database = new Database();
session_start();

//Get users and evaluations
$users = $database->getTable("t_user");
$evaluations = $database->getAllEvaluationsFromBook($_GET["idBook"]);

//Check who's the connected user and if the user already rated the book
$alreadyRated = 0;
$activeUser;
foreach ($users as $user) {
    if ($user["usePseudo"] == $_SESSION["username"]) {
        $activeUser = $user;
    }
}
foreach ($evaluations as $evaluation) {
    if ($evaluation["idUserEvaluer"] == $activeUser["idUser"]) {
        $alreadyRated = 1;
    }
}

//Add or update a rating in the database and modify the avarage note
if (isset($_POST["addRating"])) {
    if ($alreadyRated == 0) {
        $database->addRating($_GET["idBook"], $activeUser["idUser"], $_POST["note"], $_POST["summary"]);
    } else {
        $database->updateRating($_GET["idBook"], $activeUser["idUser"], $_POST["note"], $_POST["summary"]);
    }
    $evaluations = $database->getAllEvaluationsFromBook($_GET["idBook"]);
    $database->modifyBookAverageNote(computeAverageNote($evaluations), $_GET["idBook"]);
}

header("location: rating.php?idBook=" . $_GET["idBook"])
?>