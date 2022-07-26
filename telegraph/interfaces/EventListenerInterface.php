<?php

// интерфейс для обработки событий
interface EventListenerInterface
{
    public function attachEvent(string $eventMethodName, callable $handler): void;
    public function detouchEvent(string $eventMethodName): void;
}
