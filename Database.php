<?php
/** @var string $servername */
$servername = 'localhost';
/** @var string $username */
$username = 'root';
/** @var string $password */
$password = 'root';

/**
 * connects to the database and returns a PDO to handle the actions
 * @param string $servername
 * @param string $username
 * @param string $password
 * @return Exception|PDO|PDOException
 */
function connect($servername, $username, $password)
{
    try {
        $sql = new PDO("mysql:host=$servername;dbname=book", $username, $password);
        // Set the PDO error mode to exception
        $sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $sql;
    } catch (PDOException $e) {
        return $e;
    }
}

#region Exists functions

/**
 * Checks wether the specified data exists
 * @param PDO $sql
 * @param mixed $value
 * @param string $table
 * @param string $column
 * @return bool
 */
function dataExists($sql, $value, $table, $column): bool
{
    $query = $sql->prepare("select '$column' from '$table'");
    $query->execute();

    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        if ($row[$column] == $value) {
            return true;
        }
    }
    return false;
}

/**
 * Checks wether the specified user exists
 * @param PDO $sql
 * @param string $username
 * @return bool
 */
function userExists($sql, $username): bool
{
    return dataExists($sql, $username, 't_user', 'usePseudo');
}

/**
 * Checks wether the specified author exists
 * @param PDO $sql
 * @param string $name
 * @param string $surname
 * @return bool
 */
function authorExists($sql, $name, $surname): bool
{
    return dataExists($sql, $name, 't_author', 'autName')
        && dataExists($sql, $surname, 't_author', 'autSurname');
}

/**
 * Checks wether the specified editor exists
 * @param PDO $sql
 * @param string $name
 * @return bool
 */
function editorExists($sql, $name): bool
{
    return dataExists($sql, $name, 't_editor', 'ediName');
}

/**
 * Checks wether the specified category exists
 * @param PDO $sql
 * @param string $name
 * @return bool
 */
function categoryExists($sql, $name): bool
{
    return dataExists($sql, $name, 't_category', 'catName');
}

#endregion

#region Add functions

/**
 * Adds some data to the database
 * @param PDO $sql
 * @param string $table
 * @param string[] $columns
 * @param string[] $values
 */
function addData($sql, $table, $columns, $values)
{
    $sql->query("insert into " . $table . " " . mergeStrings($columns) . " values " . mergeStrings($values));
}

/**
 * Merges an array as string as (..., ..., ...)
 * @param string[] $strings
 * @return string merged
 */
function mergeStrings($strings): string
{
    $stringsAsString = "";
    foreach ($strings as $string) {
        $stringsAsString = $stringsAsString . ', ' . $string;
    }
    substr_replace($stringsAsString, '(', 0, 1);
    return $stringsAsString . ')';
}

/**
 * Adds an user to the database
 * @param PDO $sql
 * @param string $username
 * @param string $password
 */
function addUser($sql, $username, $password)
{
    addData($sql, "t_user", ["usePseudo", "usePassword"], [$username, $password]);
}

/**
 * Adds an author to the database
 * @param PDO $sql
 * @param string $name
 * @param string $surname
 */
function addAuthor($sql, $name, $surname)
{
    addData($sql, "t_author", ["autName", "autSurname"], [$name, $surname]);
}

/**
 * Adds an editor to the database
 * @param PDO $sql
 * @param string $name
 */
function addEditor($sql, $name)
{
    addData($sql, "t_editor", ["ediName"], [$name]);
}

/**
 * Adds a category to the database
 * @param PDO $sql
 * @param string $name
 */
function addCategory($sql, $name)
{
    addData($sql, "t_category", ["catName"], [$name]);
}

#endregion

//TODO remove unnecessary lines of code
try {
    $sql = new PDO("mysql:host=$servername;dbname=book", $username, $password);
    // set the PDO error mode to exception
    $sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully <br>";

    $query = $sql->prepare("select * from t_user");
    $query->execute();
    $canInsert = true;

    //check if the username is already used or no
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        if ($row['usePseudo'] == $username) {
            $canInsert = false;
            echo "Account already existing- exiting";
            break;
        }
    }

    //create an account if the username is not used
    if ($canInsert) {
        $sql->query("insert into t_user (usePseudo, usePassword) values ('$username', '$password')");
        echo "created accounts !";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}