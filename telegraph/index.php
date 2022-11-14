<?php

include_once './autoload.php';

$file = new FileStorage();

/**
 *  Все, что ниже для тестирования работоспособности
 */
//$file->create($telegraph);
//$file->create($telegraph1);
//$file->delete('test-text1_06.07.2022_2');
//$telegraph1 = new TelegraphText('Evgeniy', 'test-text1');
//$telegraph1->editText('Заголовок', 'Текст переданный из функции для добавления/редактирования текста');
//$telegraph = new TelegraphText('Evgeniy2', 'test-text1');
//$telegraph->editText('Заголовок2', '222222fsdfs22sgsdb2222gvdvb222222xvsdv');
//$telegraph->text = 'Используйте «магические» геттеры';
//echo $telegraph->text;
//$telegraph->storeText();
//var_dump($telegraph->loadText());
//var_dump($telegraph1);

//$telegraph->text = 'Обновляю текст объекта телеграф для проверки метода update';
//var_dump($telegraph->slug);
//$file->update($telegraph->slug, $telegraph);
//var_dump($file->read($telegraph->slug));
//var_dump($file->create($telegraph1));
//var_dump($file->list());

//$file->logMessage('Тестирование записи ошибок.');
//$file->logMessage('Произошла ошибка.');
//$file->logMessage('Внимание, будьте бдительны.');
//$file->logMessage('Ошибки это нормально. Не сдавайся.');

//var_dump($file->lastMessages(3));

//$handler = function ()
//{
//    echo "Привет я анонимная функция Handler";
//};
//
////var_dump($handler());
//
//$file->attachEvent('update', 'count');
//$file->attachEvent('list', 'array_pop');
//$file->attachEvent('read', $handler);
//$file->attachEvent('create', 'array_sum');
//$file->detouchEvent('list');
//var_dump($file->events);
//var_dump($file->list());
