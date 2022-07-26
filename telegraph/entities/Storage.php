<?php

require_once __DIR__ . './../interfaces/EventListenerInterface.php';
require_once __DIR__ . './../interfaces/LoggerInterface.php';

// абстрактный класс для хранилища данных
abstract class Storage implements LoggerInterface, EventListenerInterface
{
    //массив для хранения событий и обработчиков
    public $events = [];

    abstract public function create(TelegraphText $objectToSave);
    abstract public function read(string $slug);
    abstract public function update(string $slug, TelegraphText $updatedObject);
    abstract public function delete(string $slug);
    abstract public function list();

    /**
     * Реализация метода интерфейса LoggerInterface
     * записывает ошибки в файл logs.txt
     * @param string $errorMessage
     */
    public function logMessage(string $errorMessage): void
    {
        file_put_contents('logs.txt', $errorMessage . PHP_EOL, FILE_APPEND);
    }

    /**
     * Реализация метода интерфейса LoggerInterface
     * возвращает $numberOfErrors последних ошибок
     * @param int $numberOfErrors
     * @return array
     */
    public function lastMessages(int $numberOfErrors): array
    {
        return array_slice(file('logs.txt'), -$numberOfErrors);
    }

    /**
     * Реализация метода интерфейса EventListenerInterface
     * Присваивает событию обработчик
     * @param string $eventName
     * @param callable $callbackFunc
     */
    public function attachEvent(string $eventName, callable $callbackFunc): void
    {
        $this->events[$eventName] = $callbackFunc;
    }

    /**
     * Реализация метода интерфейса EventListenerInterface
     * удаляет обработчик из события
     * @param string $eventName
     */
    public function detouchEvent(string $eventName): void
    {
        unset($this->events[$eventName]);
    }
}
