<?php

/**
 * Authors : Julien Leresche & Simon Guggisberg
 * Date : 02.11.2020
 * Description : various utilities and functions to use throughout the code
 */

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
?>