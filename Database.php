<?php

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

/**
 * Merges an array as string as the following : (..., ..., ...)
 * @param string[] $strings
 * @return string merged
 */
function mergeStrings($strings): string
{
    $stringsAsString = "";
    foreach ($strings as $string) {
        $stringsAsString = $stringsAsString . ', ' . $string;
    }
    $stringsAsString = substr_replace($stringsAsString, '(', 0, 2);
    return $stringsAsString . ')';
}

#region ExistsAt functions

/**
 * Checks wether the specified data exists
 * @param PDO $sql
 * @param mixed $value
 * @param string $table
 * @param string $column
 * @return bool
 */
function dataExistsAt($sql, $value, $table, $column): int
{
    $query = $sql->prepare("select " . $column . " from " . $table);
    $query->execute();

    $i = -1;
    while ($row = $query->fetch(PDO::FETCH_ASSOC, $i++)) {
        if ($row[$column] == $value) {
            return $i;
        }
    }
    return -1;
}

/**
 * Checks wether the specified user exists
 * @param PDO $sql
 * @param string $username
 * @return bool
 */
function userExistsAt($sql, $username): int
{
    return dataExistsAt($sql, $username, 't_user', 'usePseudo');
}

/**
 * Checks wether the specified author exists
 * @param PDO $sql
 * @param string $name
 * @param string $surname
 * @return bool
 */
function authorExistsAt($sql, $name, $surname): int
{
    //TODO test fix for existsat
    $query = $sql->prepare("select autName, autSurname from t_author");
    $query->execute();

    $i = -1;
    while ($row = $query->fetch(PDO::FETCH_ASSOC, $i++)) {
        if (($row['autName'] == $name) && ($row['autSurname'] == $surname)) {
            return $i;
        }
    }
    return -1;
}

/**
 * Checks wether the specified editor exists
 * @param PDO $sql
 * @param string $name
 * @return bool
 */
function editorExistsAt($sql, $name): int
{
    return dataExistsAt($sql, $name, 't_editor', 'ediName');
}

/**
 * Checks wether the specified category exists
 * @param PDO $sql
 * @param string $name
 * @return bool
 */
function categoryExistsAt($sql, $name): int
{
    return dataExistsAt($sql, $name, 't_category', 'catName');
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
function addData($sql, $table, $columns, $values): int
{
    $sql->query("insert into " . $table . " " . mergeStrings($columns) . " values " . mergeStrings($values));
    //$sql = mysqli_query("select * from " . $table);
    return 0;
}

/**
 * Adds an user to the database
 * @param PDO $sql
 * @param string $username
 * @param string $password
 */
function addUser($sql, $username, $password)
{
    addData($sql, "t_user", ["usePseudo", "usePassword"], ["'$username'", "'$password'"]);
}

/**
 * Adds an author to the database
 * @param PDO $sql
 * @param string $name
 * @param string $surname
 */
function addAuthor($sql, $name, $surname): int
{
    return addData($sql, "t_author", ["autName", "autSurname"], ["'$name'", "'$surname'"]);
}

/**
 * Adds an editor to the database
 * @param PDO $sql
 * @param string $name
 */
function addEditor($sql, $name): int
{
    return addData($sql, "t_editor", ["ediName"], ["'$name'"]);
}

/**
 * Adds a category to the database
 * @param PDO $sql
 * @param string $name
 */
function addCategory($sql, $name): int
{
    return addData($sql, "t_category", ["catName"], ["'$name'"]);
}

/**
 * Adds a book to the database with its foreign keys
 * @param PDO $sql
 * @param string $title
 * @param int $numberPages
 * @param string $excerptLink
 * @param string $summary
 * @param int $year
 * @param string $coverLink
 * @param int $idAuthor
 * @param int $idUser
 * @param int $idEditor
 * @param int $idCategory
 */
function addBook($sql, $title, $numberPages, $excerptLink, $summary, $year, $coverLink, $idAuthor, $idUser, $idEditor, $idCategory)
{
    addData($sql, "t_book",
        ["booTitle", "booNbrPages", "booExcerptLink", "booSummary", "booYearEdited", "booAverageNotes", "booCoverLink", "idAuthor", "idUser", "idEditor", "idCategory"],
        ["'$title'", $numberPages, "'$excerptLink'", "'$summary'", $year, -1.0,"'$coverLink'", $idAuthor, $idUser, $idEditor, $idCategory]);
}

#endregion