<?php

class TelegraphText
{
    public $title;// заголовок текста
    public $text;// текст
    public $author;// имя автора
    public $slug;// уникальное имя файла, в котором хранятся данные
    public $publiched;// дата и время последнего изменения текста
    public $fileStorage; //объект класса FileStorage

    public function __construct(string $author, string $slug, FileStorage $fileStorage)
    {
        $this->fileStorage = $fileStorage;
        $this->author = $author;
        $this->slug = $slug;
        $this->publiched = date("d.m.Y H:i:s");
    }

    //добавление/редактирование текста в объекте
    public function editText (string $title, string $text): void
    {
        $this->title = $title;
        $this->text = $text;
    }

    //запись массива с данными в файл
    public function storeText(TelegraphText $telegraphText): void
    {
        $storageText = [
            'author' => $this->author,
            'published' => $this->publiched,
            'title' => $this->title,
            'text' => $this->text,
        ];
        file_put_contents($this->fileStorage->create($telegraphText), serialize($storageText));
    }

    //загрузка текста из файла в объект
    public function loadText(): ?string
    {
        if (file_exists($this->slug) && filesize($this->slug) != 0) {
            $storageText = $this->fileStorage->read($this->slug);
            var_dump($storageText);

            $this->author = $storageText['author'];
            $this->publiched = $storageText['published'];
            $this->title = $storageText['title'];
            $this->text = $storageText['text'];

            return $this->text;
        }
        return null;
    }
}

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
//        foreach (array_diff(scandir(__DIR__), ['.', '..', '.git']) as $item) {
//
//            if (unserialize(file_get_contents($item)) != false) {
//                $arr[] = unserialize(file_get_contents($item));
//            }
//        }
//        return $arr;
        return array_filter(array_map('unserialize',
            array_map('file_get_contents', array_diff(scandir(__DIR__), ['.', '..', '.git',]))));
    }
}

$file = new FileStorage();
//$file->create($telegraph1);
//$file->delete('test-text1_06.07.2022_2');
//$telegraph->text = 'Обновляю текст объекта телеграф для проверки метода update';
//$file->update($telegraph->slug, $telegraph);
//var_dump($file->read($telegraph->slug));
//var_dump($file->create($telegraph1));
//var_dump($file->list());

$telegraph1 = new TelegraphText('Evgeniy', 'test-text1', $file);
$telegraph1->editText('Заголовок', 'Текст переданный из функции для добавления/редактирования текста');
$telegraph = new TelegraphText('Evgeniy2', 'test-text1', $file);
$telegraph->editText('Заголовок2', '222222fsdfs22sgsdb2222gvdvb222222xvsdv');


$telegraph->storeText($telegraph);
$telegraph1->loadText();
//var_dump($telegraph->loadText());
//var_dump($telegraph);
