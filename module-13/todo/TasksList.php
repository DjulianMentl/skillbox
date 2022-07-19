<?php

class TasksList
{
    //путь к файлу, где будет храниться список задача
    const SAVE_FILE_NAME = 'tasks-list.json';

    //список задач
    private $tasks = [];

    public function __construct()
    {
        //При создании объекта списка - загружаем задачи из файла
        if (file_exists(self::SAVE_FILE_NAME)) {
            if ($jsonContent = json_decode(file_get_contents(self::SAVE_FILE_NAME), JSON_OBJECT_AS_ARRAY)) {
                $this->tasks = $jsonContent;
            }
        }
    }

    //Сохранить список задач в файл
    protected function saveList()
    {
        $jsonContent = json_encode($this->tasks);
        file_put_contents(self::SAVE_FILE_NAME, $jsonContent);
    }

    //Изменить статус задачи
    public function changeTaskStatus($id)
    {
        if (isset($this->tasks[$id])) {
            $this->tasks[$id]['done'] = ! $this->tasks[$id]['done'];
        }
        $this->saveList();
    }

    //Удалить задачу
    public function removeTask($id)
    {
        if (isset($this->tasks[$id])) {
            unset($this->tasks[$id]);
        }
        $this->saveList();
    }

    //Добавить задачу
    public function addNewTask($title)
    {
        $this->tasks[] = ['title' => $title, 'done' => false];

        $this->saveList();
    }

    //Вернуть список задач
    public function getTasks(): ?array
    {
        return $this->tasks;
    }
}

$taskList = new TasksList();

if (isset($_GET['change_status']) && isset($_GET['id'])) {
    $taskList->changeTaskStatus($_GET['id']);
} elseif (isset($_GET['remove_task']) && isset($_GET['id'])) {
    $taskList->removeTask($_GET['id']);
} elseif (isset($_POST['task_name'])) {
    $taskList->addNewTask($_POST['task_name']);
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>TODO лист</title>
    <style>
        .tasks-table{
            padding: 10px;
            background-color: rgba(250, 255, 177, 0.64);
            margin-bottom: 50px;
        }

        .tasks-table td {
            padding: 8px;
            border-bottom: 1px dotted black;
        }

        .task-name {
            min-width: 270px;
        }
    </style>
</head>
<body>
<h1>Список моих задач: </h1>

<table class="tasks-table" >
    <tbody>
    <?php foreach ($taskList->getTasks() as $key => $task) {?>
    <tr>
        <td><a href="./TasksList.php?change_status&id=<?= $key;?>"><input type="checkbox" <?= $task['done'] ? 'checked' : '';?>></a></td>
        <td class="task-name"><?= $task['title'];?></td>
        <td><a href="./TasksList.php?remove_task&id=<?= $key;?>"><input type="button" value="X"></a></td>
    </tr>
    <?php } ?>
    </tbody>
</table>

<form method="post" action="./TasksList.php">
    <label>Добавить задачу: </label>
    <input type="text" size="20" name="task_name">
    <input type="submit" value="Добавить">
</form>
</body>
</html>
