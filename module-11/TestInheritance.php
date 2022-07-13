<?php

class ParentTest
{
    protected const TEST_CONSTANT = 'parent';

    public function showField()
    {
        echo static::TEST_CONSTANT . PHP_EOL;
    }
}

class InheritTest extends ParentTest
{
    protected const TEST_CONSTANT = 'Inherit';
}

$inherit = new InheritTest();
$inherit->showField();