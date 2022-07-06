<?php

abstract class Vehicle
{
    abstract function move();
}

class Car extends Vehicle
{
    function move()
    {
        echo 'Завести мотор' . PHP_EOL . 'начать движение' . PHP_EOL;
    }
}

class Bicycle extends Vehicle
{
    function move()
    {
        echo 'Крутить педали';
    }
}

$car = new Car();
$bicycle = new Bicycle();

$car->move();
$bicycle->move();