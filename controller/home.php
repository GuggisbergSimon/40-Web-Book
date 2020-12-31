<?php

/**
 * Authors : Julien Leresche & Simon Guggisberg
 * Date : 02.11.2020
 * Description : TODO
 */

include 'functions.php';
include '../model/Database.php';
session_start();
$database = new Database();

//variables for MVC
$displayLoginSection = 'displayLoginSection';
$title = 'Accueil';
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

//display homepage
$view = file_get_contents('../view/page/home.html');
ob_start();
eval('?>' . $view);
echo ob_get_clean();

foreach ($database->getTableFirstLines("t_book", 3) as $details) {
    $findAutName = 'findAutName';
    $view = file_get_contents('../view/page/bookCardModal.html');
    ob_start();
    eval('?>' . $view);
    echo ob_get_clean();
}
?>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <?php
                foreach ($database->getTableFirstLines("t_book", 3) as $details) {
                    $view = file_get_contents('../view/page/bookCard.html');
                    ob_start();
                    eval('?>' . $view);
                    echo ob_get_clean();
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