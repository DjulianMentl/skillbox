<?php

function __autoload($classname)
{
    include_once './' . $classname . '.php';
}

$testObject = new TestClass();
$testObject->testExecution();

$anotherObject = new AnotherClass();
$anotherObject->testExecution();