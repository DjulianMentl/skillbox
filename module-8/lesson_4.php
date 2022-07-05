<?php

class Student
{
    public static $department = 'Иностранных языков';
    public $name;

    public function __construct(string $name)
    {
        $this->name;
    }

    public function showDepartment()
    {
        echo self::$department . PHP_EOL;
    }

    public static function changeDepartment($department)
    {
        self::$department = $department;
    }
}

$studentOne = new Student('Василий Иванов');
$studentеTwo = new Student('Евгений Костров');


$studentOne->showDepartment();
Student::changeDepartment('Русского языка');
$studentOne->showDepartment();
$studentеTwo->showDepartment();