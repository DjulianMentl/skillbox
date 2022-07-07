<?php

// подключаем класс TelegraphText для того, чтобы была возможность использовать его объекты
include 'TelegraphText.php';

// описываем абстрактные классы для проекта "Телеграф"

// абстрактный класс для хранилища данных
abstract class Storage
{
    abstract function create(TelegraphText $objectToSave);
    abstract function read(string $slug);
    abstract function update(string $slug, TelegraphText $updatedObject);
    abstract function delete(string $slug);
    abstract function list();
}

// абстрактный класс для отображения данных
abstract class View
{
    abstract function displayTextByld($id);
    abstract function displayTextByUrl($url);
}

// абстрактный класс для описания пользователей
abstract class User
{
    public $id;
    public $name;
    public $role;
    abstract function getTextsToEdit();
}

// класс FileStorage реализует методы для хранения данных в виде файлов
class FileStorage extends Storage
{
    //записывает в файл сериализованный объект класса TelegraphText и возвращает имя файла
    function create(TelegraphText $objectToSave): string
    {
        $date = new DateTime();
        $fileName = $objectToSave->slug . '_' . $date->format('d.m.Y');

        //если файл с таким именем уже существует, добавляем к названию цифру-постфикс
        $fileNamePostfixum  = 1;
        while (file_exists($fileName)) {
            $fileName = $objectToSave->slug . '_' . $date->format('d.m.Y') . '_' . $fileNamePostfixum;
            $fileNamePostfixum++;
        }
        //переопределяем название файла в переданном объекте и записываем в файл этот объект
        $objectToSave->slug = $fileName;
        file_put_contents($objectToSave->slug, serialize($objectToSave));

        return $objectToSave->slug;
    }

    // получает данные об объекте из файла и возвращает в виде объекта TelegraphText
    function read(string $slug): TelegraphText
    {
        return unserialize(file_get_contents($slug));
    }

    // обновляет данные в файле
    function update(string $slug, TelegraphText $updatedObject): void
    {
        file_put_contents($slug, serialize($updatedObject));
    }

    // удаляет файл-объект из хранилища
    function delete(string $slug): void
    {
       unlink($slug);
    }

    // возвращает массив со всеми объектами в хранилище
    function list(): array
    {
        // 1. получаем список всех файлов в папке
        // 2. записываем содержимое файлов в массив
        // 3. проводим десериализацию элементов массива
        // 4. удаляем из массива элементы десериализация которых не удалась (вернула false)
        return array_filter(array_map('unserialize',
            array_map('file_get_contents', array_diff(scandir(__DIR__), ['.', '..', '.git',]))));
    }
}

$file = new FileStorage();
$file->create($telegraph);
$file->create($telegraph1);
//$file->delete('test-text1_06.07.2022_2');
$telegraph->text = 'Обновляю текст объекта телеграф для проверки метода update';
var_dump($telegraph1->slug);
//$file->update($telegraph->slug, $telegraph);
//var_dump($file->read($telegraph->slug));
//var_dump($file->create($telegraph1));
var_dump($file->list());
