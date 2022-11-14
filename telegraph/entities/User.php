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
     * @param string $event
     * @param callable $eventHandler
     */
    public function attachEvent(string $event, callable $eventHandler): void
    {
        $this->events[$event] = $eventHandler;
    }

    /**
     * Реализация метода интерфейса EventListenerInterface
     * удаляет обработчик из события
     * @param string $event
     */
    public function detouchEvent(string $event): void
    {
        unset($this->events[$event]);
    }
}
