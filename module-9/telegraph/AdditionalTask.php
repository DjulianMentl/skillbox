<?php

/*
 * ДОПОЛНИТЕЛЬНОЕ ЗАДАНИЕ
 * 10. Выполните по желанию: попробуйте в методах loadText и storeText класса Text
 * использовать объект класса FileStorage.
 * Сам объект передайте в качестве параметра конструктора класса Text.
 */
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
    // имя файла получаю из объекта класса FileStorage использую его метод create()
    public function storeText(): void
    {
        $storageText = [
            'author' => $this->author,
            'published' => $this->publiched,
            'title' => $this->title,
            'text' => $this->text,
        ];
        file_put_contents($this->fileStorage->create($this), serialize($storageText));
    }

    //загрузка текста из файла в объект
    // получаю данные из массива используя метод read() класса FileStorage
    public function loadText(): ?string
    {
        if (file_exists($this->slug) && filesize($this->slug) != 0) {
            $storageText = $this->fileStorage->read($this->slug);

            $this->author = $storageText['author'];
            $this->publiched = $storageText['published'];
            $this->title = $storageText['title'];
            $this->text = $storageText['text'];

            return $this->text;
        }
        return null;
    }
}

// описываем абстрактные классы для проекта "Телеграф"

// Storage абстрактный класс для хранилища данных
abstract class Storage
{
    abstract function create(TelegraphText $objectToSave);
    abstract function read(string $slug);
    abstract function update(string $slug, TelegraphText $updatedObject);
    abstract function delete(string $slug);
    abstract function list();
}

// View абстрактный класс для отображения данных
abstract class View
{
    abstract function displayTextByld($id);
    abstract function displayTextByUrl($url);
}

// User абстрактный класс для описания пользователей
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
$telegraph->loadText();
//var_dump($telegraph->loadText());
//var_dump($telegraph);
