<?php
$a = 322;

if ($a <= 0) {
    echo 'A <= 0';
} else {
    if ($a > 10) {
        echo 'A > 10';
    } elseif ($a > 5) {
        echo 'A > 5';
    } elseif ($a > 3) {
        echo 'A > 3';
    } else {
        echo 'A < 3';
    }
}

