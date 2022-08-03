<?php

//реализуем автоматическую загрузку классов зависимостей composer
require_once __DIR__ . '/vendor/autoload.php';

// автозагрузчик классов из папки /entities/
function loaderEntities(string $className): void
{
    if (file_exists(__DIR__ . '/entities/' . $className . '.php')) {
        require_once __DIR__ . '/entities/' . $className . '.php';
    }
}

// автозагрузчик интерфейсов из папки /interfaces/
function loaderInterfaces(string $interfaceName): void
{
    if (file_exists(__DIR__ . '/interfaces/' . $interfaceName . '.php')) {
        require_once __DIR__ . '/interfaces/' . $interfaceName . '.php';
    }
}

spl_autoload_register('loaderInterfaces');
spl_autoload_register('loaderEntities');