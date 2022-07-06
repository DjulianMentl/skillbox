<?php

class Square
{
    public static $quantity = 0;

    public static function changeQuantity()
    {
        self::$quantity++;
    }

    public function showQuantity()
    {
        echo self::$quantity;
    }
}

echo Square::$quantity . PHP_EOL;
Square::changeQuantity();
Square::changeQuantity();
Square::changeQuantity();
echo Square::$quantity . PHP_EOL;

$square = new Square();
$square->showQuantity();