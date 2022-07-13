<?php

class Test
{
    public static $publicField = 20;
    private static $privateField = 10;
    protected static $protectedField = 15;
}

class Inherit extends Test
{
    /**
     * @param int $privateField
     */
    public function showPrivateField(): void
    {
        echo self::$privateField;
    }

    public function showProtectedField(): void
    {
        echo self::$protectedField;
    }
}

$testObject = new Inherit();
//echo Test::$publicField . PHP_EOL;
//echo $testObject::$publicField . PHP_EOL;

//echo Test::$privateField . PHP_EOL;
//echo $testObject::$privateField . PHP_EOL;
$testObject->showProtectedField();

//echo Test::$protectedField;
//echo $testObject::$protectedField;