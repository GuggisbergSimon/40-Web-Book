<?php
/**
 * Authors : Julien Leresche & Simon Guggisberg
 * Date : 02.11.2020
 * Description : various utilities and functions to use throughout the code
 */

/**
 * @param $path
 * @return false|string
 */
function display($path)
{
    //declare variable present in php here

    $view = file_get_contents($path);
    ob_start();
    eval('?>' . $view);
    return ob_get_clean();
}

/**
 * Concatenation of author's name and surname
 * @param array $table
 * @param int $index
 * @return string
 */
function findAutName(array $table, int $index): string
{
    return $table[$index - 1]["autName"] . " " . $table[$index - 1]["autSurname"];
}

function displayLoginSection()
{
    if(isset($_SESSION["isConnected"]))
    {
      echo '<form method="post">
              <div class="form-group" >
              <label for="username">Connecté en tant que ' . $_SESSION["username"] . ' </label>
              </div>
              <button type="submit" name="logout" class="btn btn-primary">Logout</button>
            </form>';
    }
    else
    {
      echo '<form method="post">
              <div class="form-group" >
                <input type="text" class="form-control" id="username" aria-describedby="userHelp" name="username" placeholder="Username">
              </div>
              <div class="form-group">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
              </div>
              <button type="submit" name="login" class="btn btn-primary">Login</button>
            </form>';
    }
}

function login($pageName,$users)
{
    foreach($users as $user)
    if($_POST["username"] == $user["usePseudo"] && password_verify($_POST["password"], $user["usePassword"]))
    {
        $_SESSION["isConnected"] = 1;
        $_SESSION["username"] = $_POST["username"];
        header("location: " . $pageName);
    }
}

function logout($pageName)
{
    session_destroy();
    header("location: " . $pageName);
}
?>