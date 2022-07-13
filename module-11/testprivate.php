<?php

class TestParent
{
    private function testMethod()
    {
        echo 'It works!';
    }

    public function showMessage()
    {
        $this->testMethod();
    }
}

class TestInheritance extends TestParent
{
    public function testPublic()
    {
        $this->testMethod();
    }
}

$testParrentObj = new TestParent();
$testInheritanceObj = new TestInheritance();
//$testParrentObj->showMessage();
$testInheritanceObj->showMessage();
//$testParrentObj->testMethod();

