<?php
/**
 * Concatenation of author's name and surname
 * @param string $table
 * @param int $index
 * @return string
 */
function findAutName(array $table, int $index): string 
{
    return $table[$index - 1]["autName"] . " " . $table[$index - 1]["autSurname"];
}

/**
 * Read a table and return an array with table's informations
 * @param string $tableName
 * @param string $sql
 * @return array 
 */
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