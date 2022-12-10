<?php

// Преобразование римских в арабские
function romanToInt($s) {
    $arabicInteger = 0;
    $len = strlen($s);

    for ($i = 0; $i < $len; $i++) {
        switch ($s[$i]) {
            case 'I' :
                if (($i + 1) < $len && $s[$i+1] === 'V') {
                    $arabicInteger += 4;
                    $i++;
                    break;
                } elseif (($i + 1) < $len && $s[$i+1] === 'X') {
                    $arabicInteger += 9;
                    $i++;
                    break;
                }
                $arabicInteger += 1;
                break;
            case 'V' :
                $arabicInteger += 5;
                break;
            case 'X' :
                if (($i + 1) < $len && $s[$i+1] === 'L') {
                    $arabicInteger += 40;
                    $i++;
                    break;
                } elseif (($i + 1) < $len && $s[$i+1] === 'C') {
                    $arabicInteger += 90;
                    $i++;
                    break;
                }
                $arabicInteger += 10;
                break;
            case 'L' :
                $arabicInteger += 50;
                break;
            case 'C' :
                if (($i + 1) < $len && $s[$i+1] === 'D') {
                    $arabicInteger += 400;
                    $i++;
                    break;
                } elseif (($i + 1) < $len && $s[$i+1] === 'M') {
                    $arabicInteger += 900;
                    $i++;
                    break;
                }
                $arabicInteger += 100;
                break;
            case 'D' :
                $arabicInteger += 500;
                break;
            case 'M' :
                $arabicInteger += 1000;
                break;
        }
    }
    return $arabicInteger;
}
echo 'Int: ';
echo romanToInt('MCMXCIV');