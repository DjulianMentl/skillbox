<?php

// абстрактный класс для описания пользователей
abstract class User implements EventListenerInterface
{
    //массив для хранения событий и обработчиков
    protected $events = [];
    protected $id;
    protected $name;
    protected $role;

    abstract public function getTextsToEdit();

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
