<?php

class Employee
{
    public $name, $position, $age;

    public function setParameters($name, $position, $age)
    {
        $this->name = $name;
        $this->position = $position;
        $this->age = $age;
    }

    public function showEmployeeInfo()
    {
        echo "Сотрудник $this->name в должности $this->position" .PHP_EOL;
    }
}

class Accountant extends Employee
{
    public function prepareReport()
    {
        echo 'Я готовлю отчет' . PHP_EOL;
    }
}

class CEO extends Employee
{
    public function fireEmployee()
    {
        echo 'Я увольняю сотрудника' . PHP_EOL;
    }
}

class Welder extends Employee
{
    public function makeWeld()
    {
        echo 'Я делаю сварку металлоконструкций' . PHP_EOL;
    }
}

$welder = new Welder();
$welder->setParameters('Vasya', 'Welder', 43);
$welder->showEmployeeInfo();
$welder->makeWeld();