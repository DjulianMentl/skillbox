<?php

// интерфейс для реализации логгирования
interface LoggerInterface
{
    public function logMessage(string $errorMessage): void;
    public function lastMessages(int $showNumberOfErrors): array;
}
