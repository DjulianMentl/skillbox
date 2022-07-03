<?php
//АНОНИМНЫЕ ФУНКЦИИ И ЗАМЫКАНИЯ

$a = 1;
$testCloseure = function () use ($a) {
    echo $a . PHP_EOL;
    $a = 5;
    echo $a . PHP_EOL;
};
$testCloseure();
echo $a . PHP_EOL;

//тестовая программа для проверки пароля с использованием анонимной функции

$password = 'password';

$checkPassword = function ($userPassword) use ($password) {
    return $userPassword === $password;
};

do {
    $userPassword = readline('Введите пароль: ');
    if ($checkPassword($userPassword)) {
        echo 'Пароль верен' . PHP_EOL;
        break;
    } else {
        echo 'Пароль не верен' . PHP_EOL;
    }
} while (true);


//стрелочные функции

$b = 2;
$testClosure1 = fn () => $b;

echo $testClosure1();