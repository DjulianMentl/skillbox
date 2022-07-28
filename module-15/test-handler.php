<?php

function errorHandler(int $level, string $msg, string $file, int $line): void
{
    if ($level === E_WARNING) {
        echo 'Что-то пошло не так. Мы скоро все исправим';
        $dt = new \DateTime();
        file_put_contents('admin.log', $dt->format('Y-d-m H:i:s') . ' ' . $msg . ' in file ' . $file . ' in line ' . $line . PHP_EOL, FILE_APPEND);
    }
}

set_error_handler('errorHandler');

$a = [];
echo $a[4];
