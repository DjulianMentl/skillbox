<?php

class CardNumberException extends Exception
{

}

function checkNumberFormat(int $cardNumber)
{
    if (strlen($cardNumber) !== 16) {
        throw new CardNumberException('Нерпавильный формат номера карты');
    }

    return 'Формат карты правильный' . PHP_EOL;
}

function testCall()
{
    try {
        echo checkNumberFormat(1234567812345678);
    } catch (CardNumberException $exception) {
        echo $exception->getMessage() . PHP_EOL;
        return false;
    } finally {
        echo 'Выполнение завершено' . PHP_EOL;
    }

}

var_dump(testCall());

echo 'Я стану великим программистом';

