<?php

/**
 * Authors : Julien Leresche & Simon Guggisberg
 * Date : 02.11.2020
 * Description : Page showing the full list of the books
 */

include 'functions.php';
include '../model/Database.php';
session_start();
$database = new Database();

//variables for MVC
$displayLoginSection = 'displayLoginSection';
$title = 'Bibliothèque d\'ouvrages';
$buttonTitle = 'Accueil';
$buttonPageName = 'home.php';
$findAutName = 'findAutName';

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

//display homepage
$view = file_get_contents('../view/page/home.html');
ob_start();
eval('?>' . $view);
echo ob_get_clean();

if(isset($_SESSION['isConnected']))
{
    foreach ($database->getTable("t_book") as $details) {     
        $view = file_get_contents('../view/page/bookCardModal.html');
        ob_start();
        eval('?>' . $view);
        echo ob_get_clean();
    }
}
?>

<div class="album py-5 bg-light">
    <?php
    //display category selection menu
    $view = file_get_contents('../view/page/categorySelection.html');
    ob_start();
    eval('?>' . $view);
    echo ob_get_clean();
    ?>
    <div class="container">
        <div class="row">
            <?php
            //display all books 
            if(isset($_SESSION['isConnected']))
            {
                if(isset($_POST['category']) && $_POST['category'] != 0)
                {
                    foreach ($database->getBooksByCategoryId($_POST['category']) as $details) {
                        $view = file_get_contents('../view/page/bookCard.html');
                        ob_start();
                        eval('?>' . $view);
                        echo ob_get_clean();
                    }
                } else {
                    foreach ($database->getTable("t_book") as $details) {
                        $view = file_get_contents('../view/page/bookCard.html');
                        ob_start();
                        eval('?>' . $view);
                        echo ob_get_clean();
                    }
                }
            } else {
                if(isset($_POST['category']) && $_POST['category'] != 0)
                {
                    foreach ($database->getBooksByCategoryId($_POST['category']) as $details) {
                        $view = file_get_contents('../view/page/bookCardLogout.html');
                        ob_start();
                        eval('?>' . $view);
                        echo ob_get_clean();
                    }
                } else {
                    foreach ($database->getTable("t_book") as $details) {
                        $view = file_get_contents('../view/page/bookCardLogout.html');
                        ob_start();
                        eval('?>' . $view);
                        echo ob_get_clean();
                    }
                }
            }
            ?>
        </div>
    </div>
</div>

<?php
//display footer
$view = file_get_contents('../view/footer.html');
ob_start();
eval('?>' . $view);
echo ob_get_clean();
?>