<?php

//пример рекурсивной функции
function testRec(int $callNumber): void
{
    if ($callNumber > 0) {
        testRec($callNumber - 1);
    }
    echo "Осталось шагов: " . $callNumber . "\n";
}

//testRec(2);

//вычисление факториала числа
//function factorial(int $num): void
//{
//    $fact = 1;
//    for ($i = 1; $i <= $num; $i++) {
//        $fact *= $i;
//    }
//    echo $fact;
//}
function factorial(int $num): int
{
    return $num > 1 ? $num * factorial($num - 1) : $num;
}

//echo factorial(4);

//callback функции

$simpleNumber = 7;
function cbOne($name)
{
    return "My name is " . $name . PHP_EOL;
}

function runCallBack($fName)
{
    if (is_callable($fName)) {
        echo call_user_func('cbOne', $fName) . PHP_EOL;
    }

}

runCallBack('cbOne');
runCallBack('simpleNumber');

//пример работы с array_map

//задача реализовать функцию для вычесления факториала каждого элемента массива
// и записи его в массив
$numbers = [1, 2, 3, 4, 5,];

$factorials = array_map('factorial', $numbers);

//echo "Результат:" . PHP_EOL;
//print_r($factorials);
//echo "Исходный массив:" . PHP_EOL;
//print_r($numbers);

// вычисляем квадратный корень элементов массива $numbers

//$newNumbers = array_map('sqrt', $numbers);
//echo "Результат:" . PHP_EOL;
//print_r($newNumbers);
//echo "Исходный массив:" . PHP_EOL;
//print_r($numbers);