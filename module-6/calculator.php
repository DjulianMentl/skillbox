<?php

$supportedOperator = ['+', '-', '*'];
$callsHistory = [];

/**
 * выполняет арифметическую операцию в соответствии с оператором
 * @param int $num1
 * @param int $num2
 * @param string $operation
 * @return int
 */
function calculateOperation(array &$history, int $num1, int $num2, string $operation = '+') : int
{
    $history[] = $num1 . $operation . $num2;
    return $operation == '+' ? $num1 + $num2 :
            ($operation == '-' ? $num1 - $num2 : $num1 * $num2);
}

/**
 * @param string $userInput
 * @param string $operator
 * @return array|false
 */
function parseOperator(string $userInput, string $operator)
{
    $parseResult = explode($operator, $userInput);
    if ($parseResult && count($parseResult) == 2) {
        return ['operators' => $parseResult, 'operator' => $operator];
    }
    return false;
}

do {
    $userInput = readline('Введите выражение: '); //7+2
    if ($userInput == 'exit') {
        print_r($callsHistory);
    }
    foreach ($supportedOperator as $operator) {
        $parseResult = parseOperator($userInput, $operator);
        if ($parseResult) {
            echo 'Результат = ' . calculateOperation($callsHistory, $parseResult['operators'][0], $parseResult['operators'][1], $parseResult['operator']) . PHP_EOL;
        }
    }
} while (true);
