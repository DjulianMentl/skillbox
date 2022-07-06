<?php
include 'TelegraphText.php';

abstract class Storage
{
    abstract function create(TelegraphText $objectToSave);
    abstract function read(string $slug);
    abstract function update(string $slug, TelegraphText $updatedObject);
    abstract function delete(string $slug);
    abstract function list();
}

abstract class View
{
    abstract function displayTextByld($id);
    abstract function displayTextByUrl($url);
}

abstract class User
{
    public $id;
    public $name;
    public $role;
    abstract function getTextsToEdit();
}

class FileStorage extends Storage
{
    //записываем в файл сериализованный объект класса TelegraphText
    function create(TelegraphText $objectToSave): string
    {
        $date = new DateTime();
        $fileName = $objectToSave->slug . '_' . $date->format('d.m.Y');

        //если файл с таким именем уже существует, добавляем в названию цифру-постфикс
        $fileNamePostfixum  = 1;
        while (file_exists($fileName)) {
            $fileName = $objectToSave->slug . '_' . $date->format('d.m.Y') . '_' . $fileNamePostfixum;
            $fileNamePostfixum++;
        }
        $objectToSave->slug = $fileName;
        file_put_contents($objectToSave->slug, serialize($objectToSave));

        return $objectToSave->slug;
    }

    function read(string $slug): TelegraphText
    {
        return unserialize(file_get_contents($slug));
    }

    function update(string $slug, TelegraphText $updatedObject)
    {
        file_put_contents($slug, serialize($updatedObject));
    }

    function delete(string $slug): void
    {
       unlink($slug);
    }
    function list(): array
    {
        echo 'Hi';
    }
}

$file = new FileStorage();
$file->create($telegraph);
//$file->delete('test-text1_06.07.2022_2');
$telegraph->text = 'Обновляю текст объекта телеграф для проверки метода update';
var_dump($telegraph->slug);
//$file->update($telegraph->slug, $telegraph);
//var_dump($file->read($telegraph->slug));
//var_dump($file->create($telegraph1));
