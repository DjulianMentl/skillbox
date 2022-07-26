<?php

// автозагрузчик классов из папки /entities/
function loaderEntities(string $className): void
{
    if (file_exists(__DIR__ . '/entities/' . $className . '.php')) {
        require_once __DIR__ . '/entities/' . $className . '.php';
    }
}

spl_autoload_register('loaderEntities');