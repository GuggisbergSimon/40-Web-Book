<?php
function findAutName(array $tab, int $index): string 
{
    return $tab[$index - 1]["autName"] . " " . $tab[$index - 1]["autSurname"];
}
?>