<?php

//$fp = fopen('license.txt', 'r');
//
////while (! feof($fp)) {
////    $symbol = fread($fp, 1);
////    echo $symbol;
////}
//$content = fread($fp, filesize('license.txt'));

echo file_get_contents('license.txt');
