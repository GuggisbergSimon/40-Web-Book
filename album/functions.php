<?php
function findAutName(array $tab, int $index): string 
{
    return $tab[$index - 1]["autName"] . " " . $tab[$index - 1]["autSurname"];
}

function connect()
{
    try {
        $con= new PDO('mysql:host=localhost;dbname=book', "root", "root");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $con;
      } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
        return $e;
      }
}

function readTable($sql, string $tableName): array 
{
    $query = "SELECT * FROM " . $tableName;
    $data = $sql->query($query);
    $data->setFetchMode(PDO::FETCH_ASSOC);
    foreach($data as $details)
    {
      $tableInformations[] = $details;
    }
    return $tableInformations;
}
?>