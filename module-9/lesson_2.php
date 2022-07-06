<?php

class Animal
{
    public function showMyName()
    {
        echo 'I am an animal' . PHP_EOL;
    }
}

class Cat extends Animal
{
    public function showMyName()
    {
        parent::showMyName();
        echo 'I am a cat' . PHP_EOL;
    }
}

class Dog extends Animal
{
    public function showMyName()
    {
        parent::showMyName();
        echo 'I am a dog' . PHP_EOL;
    }
}

$cat = new Cat();
$dog = new Dog();

$dog->showMyName();
$cat->showMyName();
