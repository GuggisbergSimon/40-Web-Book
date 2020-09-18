<?php
$servername = "localhost";
$username = 'root';
$password = 'root';

function connect($servername, $username, $password)
{
    try {
        $sql = new PDO("mysql:host=$servername;dbname=book", $username, $password);
        // set the PDO error mode to exception
        $sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $sql;
    } catch (PDOException $e) {
        return $e;
    }
}

/**
 * @param $sql :
 * @param $value : the value we're testing
 * @param $table : the name of the table
 * @param $column : the name of the column
 * @return bool
 */
function dataExists($sql, $value, $table, $column): bool
{
    $query = $sql->prepare("select '$column' from '$table'");
    $query->execute();

    //check if the data already exists
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        if ($row[$column] == $value) {
            return true;
        }
    }
    return false;
}

function userExists($sql, $username): bool
{
    return dataExists($sql, $username, 't_user', 'usePseudo');
}

function authorExists($sql, $name, $surname): bool
{
    return dataExists($sql, $name, 't_author', 'autName')
        && dataExists($sql, $surname, 't_author', 'autSurname');
}

function addData($sql, $table, $columns, $values) {
    //$sql->query("insert into )
    //TODO add for all columns add them seperated by comma as arguments, do the same for values
}

function test()
{
    $query = $sql->query("insert into t_user (usePseudo, usePassword) values ('$username', '$password')");
}

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
            break;
        }
    }

    //create an account if the username is not used
    if ($canInsert) {
        $query = $sql->query("insert into t_user (usePseudo, usePassword) values ('$username', '$password')");
        echo "created accounts !";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>