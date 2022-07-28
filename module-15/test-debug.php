<?php

$testArray = [2, 23, 2, 5, 34, 6, 6, 88, 9];

foreach ($testArray as $key => $item) {
    if ($item === 88) {
        echo 'stop the cycle';
        break;
    }
}
