<?php

$task['done'] = false;

//варант 1
echo 'Задача выполнена: ' . ($task['done'] ? 'ДаДа' : 'НетНет'); // почему здесь всегда Да
echo PHP_EOL;
//вариант 2
echo $task['done'] ? 'Даааа' : 'Неееет'; // а в таком варианте работае нормально
