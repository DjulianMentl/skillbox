<?php

trait VehicleFunctions
{
    public function ride()
    {
        echo 'Я могу ехать' . PHP_EOL;
    }

    public function fly()
    {
        echo 'Я могу лететь' . PHP_EOL;
    }
}

trait Car
{
    public function move()
    {
        echo 'Я еду' . PHP_EOL;
    }
}

trait Plane
{
    public function move()
    {
        echo 'Я лечу' . PHP_EOL;
    }
}

class FantomasCar
{
    use Plane, Car {
        Car::move insteadof Plane;
        Plane::move as fly;
    }

    public function escape()
    {
        $this->move();
        $this->fly();
    }
}

$fantomasCar = new FantomasCar();
$fantomasCar->escape();
