<?php

$testArray = [1, 34, 2, 536, 77, 45, 22];
$anotherArray = [0, 0, 0, 0, 0, 0, 0, 0];

$fp = fopen('example_fw.txt', 'a+');
foreach ($testArray as $item) {
    fwrite($fp, $item);
}

foreach ($anotherArray as $item) {
    fwrite($fp, $item);
}

fclose($fp);

//file_put_contents('example.txt', $testArray);
////echo file_get_contents('example.txt');
//file_put_contents('example.txt', $anotherArray, FILE_APPEND);
echo file_get_contents('example_fw.txt');
