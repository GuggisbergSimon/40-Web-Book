<?php
include '../model/database.php';
$database = new Database();
session_start();

$evaluations = $database->getEvaluationsFromBook($_GET["idBook"]);
$users = $database->readTable("t_user");
$activeUser;

foreach($users as $user)
{
    if($user["usePseudo"] == $_SESSION["username"])
    {
        $activeUser = $user;
    }
}

if(isset($_POST["addRating"]))
{
    $database->addRating($_GET["idBook"],$activeUser["idUser"],$_POST["note"],$_POST["summary"]);
} 

header("location: rating.php?idBook=" . $_GET["idBook"])
?>