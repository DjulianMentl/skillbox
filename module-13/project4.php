<?php

function loaderLibOne($className)
{
    if (file_exists('./library1/' . $className . '.php')) {
        require_once './library1/' . $className . '.php';
    }
}

function loaderLibTwo($className)
{
    require_once './library2/' . $className . '.php';
}

spl_autoload_register('loaderLibOne');
spl_autoload_register('loaderLibTwo');

$anotherObject = new AnotherClass();