<?php

$testArray = [2, 23, 2, 5, 34, 6, 6, 88, 9];

foreach ($testArray as $key => $item) {
    if ($item === 88) {
//        echo 'stop the cycle';
        break;
    }
}


$mystring = 'dfdabc';
$findme = 'A';
$pos = strpos($mystring, $findme);

// Заметьте, что используется ===.  Использование == не даст верного
// результата, так как 'a' находится в нулевой позиции.
if ($pos === false) {
    echo "Строка '$findme' не найдена в строке '$mystring'";
} else {
    echo "Строка '$findme' найдена в строке '$mystring'";
    echo " в позиции $pos";
}
