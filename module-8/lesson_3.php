<?php

class TestClass
{
    private $testField1, $testField2;

    public function setValues()
    {
        $this->testField1 = 'This is';
        $this->testField2 = 'test';
    }

    public function showFields()
    {
        echo $this->testField1 . ' ' . $this->testField2 . PHP_EOL;
    }
}

$testObject = new TestClass();
$testObject->setValues();
showFields();
$testObject->showFields();

function showFields()
{
    $testField1 = 'test';
    echo $testField1 . PHP_EOL;
}
