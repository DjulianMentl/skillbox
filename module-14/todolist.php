<?php

class ToDoListStorage
{
    private array $tasks;

    public function __construct(public string $fileName = '')
    {
        if (file_exists($fileName)) {
            $this->tasks = json_decode(file_get_contents($fileName), true);
        }
    }

    public function createTask(string $taskName): void
    {
        $this->tasks[] = ['title' => $taskName, 'done' => false, 'date' => new \DateTime()];
    }

    public function removeTask(int $taskNumber): void
    {
        unset($this->tasks[$taskNumber]);
    }

    public function taskDone(int $taskNumber): void
    {
        $this->tasks[$taskNumber]['done'] = true;
    }

    public function saveToJSON(string $fileName): void
    {
        file_put_contents($fileName, json_encode($this->tasks));
    }

    public function echoVarDump(): void
    {
        var_dump($this->tasks);
    }

    public function printToDoList(): void
    {
        foreach ($this->tasks as $key => $task) {
            echo 'Задача №: ' . $key . PHP_EOL;
            echo 'Заголовок: ' . $task['title'] . PHP_EOL;
            echo 'Задача выполнена: ' . ($task['done'] ? 'Да' : 'Нет') . PHP_EOL;
            echo 'Дата постановки зададчи: ' . $task['date']->format('Y-m-d') . PHP_EOL;
        }
    }
}

$toDoList = new ToDoListStorage();

$toDoList->createTask('Накормить цыплят');
$toDoList->createTask('Сварить кашу собакам');
$toDoList->saveToJSON('todo.json');
$toDoList->taskDone(0);
$toDoList->removeTask(1);
$toDoList->printToDoList();
