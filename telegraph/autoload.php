<?php

//реализуем автоматическую загрузку классов зависимостей composer
require_once __DIR__ . '/vendor/autoload.php';

// автозагрузчик классов из папки /entities/
function loaderEntities(string $class): void
{
    if (file_exists(__DIR__ . '/entities/' . $class . '.php')) {
        require_once __DIR__ . '/entities/' . $class . '.php';
    }
}

// автозагрузчик интерфейсов из папки /interfaces/
function loaderInterfaces(string $interface): void
{
    if (file_exists(__DIR__ . '/interfaces/' . $interface . '.php')) {
        require_once __DIR__ . '/interfaces/' . $interface . '.php';
    }
}

spl_autoload_register('loaderInterfaces');
spl_autoload_register('loaderEntities');