<?php

$testArray = ['One', 'Two', 'Three',];

//element_number

if (isset($_GET['element_number']) && array_key_exists($_GET['element_number'], $testArray)) {
    echo $testArray[$_GET['element_number']] . PHP_EOL;
} else  {
    echo 'Параметр задан неверно' . PHP_EOL;
}

if (isset($_GET['message'])) {
    echo $_GET['message']
}