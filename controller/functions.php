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