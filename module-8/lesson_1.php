<?php
class Employee
{
    public $age, $gender, $name, $surname, $position;
    public function displayName(): void
    {
        echo $this->name . PHP_EOL;
    }

    public function displayAge(): void
    {
        echo $this->age . PHP_EOL;
    }

    public function changePosition(string $newPosition): void
    {
        $this->position = $newPosition;
    }
}

$employee_1 = new Employee();
$employee_2 = new Employee();

$employee_1->age = 30;
$employee_1->gender = 'male';
$employee_1->name = 'Nick';
$employee_1->surname = "ivanov";
$employee_1->position = 'CEO';

$employee_2->age = 33;
$employee_2->gender = 'female';
$employee_2->name = 'Ann';
$employee_2->surname = "Petrova";
$employee_2->position = 'Trudovik';

var_dump($employee_1);
$employee_1->displayAge();
$employee_1->changePosition('master');
echo $employee_1->position;
var_dump($employee_2);
