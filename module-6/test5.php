<?php

$numbersArray = [3, 53, 5, 2, 78, 9, 21, 14, 19];

/**
 * удаляет из массива нечетные числа
 */
function truncArray(array &$numberArray) : void
{
    foreach ($numberArray as $key => $number) {
        if ($number % 2 !== 0) {
            unset($numberArray[$key]);
        }
    }
}

truncArray($numbersArray);
print_r($numbersArray);