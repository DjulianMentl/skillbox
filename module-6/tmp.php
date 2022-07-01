<?php

//массив для хранения заголовков и текстов
$textStorage = [
    [
        'title' => 'aaa',
        'text' => 'aaaaaaaaaaaaaaaa',
    ],
    [
        'title' => 'bb',
        'text' => 'bbbbbbbbbbbbbbbbbbbbbb',
    ],
    [
        'title' => 'cc',
        'text' => 'ccccccccccccccccc',
    ],
];

$i = count($textStorage);
echo $i . PHP_EOL;


function test(array $textStorage) : void
{
    $j = count($textStorage);
    echo $j;
}

test($textStorage);
