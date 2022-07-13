<?php

// подключаем класс TelegraphText для того, чтобы была возможность использовать его объекты
include 'TelegraphText.php';

// интерфейс для реализации логгирования
interface LoggerInterface
{
    public function logMessage(string $errorMessage): void;
    public function lastMessages(int $showNumberOfErrors): array;
}

// интерфейс для обработки событий
interface EventListenerInterface
{
    public function attachEvent(string $eventMethodName, callable $handler): void;
    public function detouchEvent(string $eventMethodName): void;
}

// описываем абстрактные классы для проекта "Телеграф"

// абстрактный класс для хранилища данных
abstract class Storage implements LoggerInterface, EventListenerInterface
{
    //массив для хранения событий и обработчиков
    public $events = [];

    abstract public function create(TelegraphText $objectToSave);
    abstract public function read(string $slug);
    abstract public function update(string $slug, TelegraphText $updatedObject);
    abstract public function delete(string $slug);
    abstract public function list();

    /**
     * Реализация метода интерфейса LoggerInterface
     * записывает ошибки в файл logs.txt
     * @param string $errorMessage
     */
    public function logMessage(string $errorMessage): void
    {
        file_put_contents('logs.txt', $errorMessage . PHP_EOL, FILE_APPEND);
    }

    /**
     * Реализация метода интерфейса LoggerInterface
     * возвращает $numberOfErrors последних ошибок
     * @param int $numberOfErrors
     * @return array
     */
    public function lastMessages(int $numberOfErrors): array
    {
        return array_slice(file('logs.txt'), -$numberOfErrors);
    }

    /**
     * Реализация метода интерфейса EventListenerInterface
     * Присваивает событию обработчик
     * @param string $eventName
     * @param callable $callbackFunc
     */
    public function attachEvent(string $eventName, callable $callbackFunc): void
    {
        $this->events[$eventName] = $callbackFunc;
    }

    /**
     * Реализация метода интерфейса EventListenerInterface
     * удаляет обработчик из события
     * @param string $eventName
     */
    public function detouchEvent(string $eventName): void
    {
        unset($this->events[$eventName]);
    }
}

// абстрактный класс для отображения данных
abstract class View
{
    abstract public function displayTextByld($id);
    abstract public function displayTextByUrl($url);
}

// абстрактный класс для описания пользователей
abstract class User implements EventListenerInterface
{
    //массив для хранения событий и обработчиков
    protected $events = [];
    protected $id;
    protected $name;
    protected $role;

    abstract public function getTextsToEdit();

    /**
     * Реализация метода интерфейса EventListenerInterface
     * Присваивает событию обработчик
     * @param string $eventName
     * @param callable $callbackFunc
     */
    public function attachEvent(string $eventName, callable $callbackFunc): void
    {
        $this->events[$eventName] = $callbackFunc;
    }

    /**
     * Реализация метода интерфейса EventListenerInterface
     * удаляет обработчик из события
     * @param string $eventName
     */
    public function detouchEvent(string $eventName): void
    {
        unset($this->events[$eventName]);
    }
}

// класс FileStorage реализует методы для хранения данных в виде файлов
class FileStorage extends Storage
{
    //записывает в файл сериализованный объект класса TelegraphText и возвращает имя файла
    public function create(TelegraphText $objectToSave): string
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
    public function read(string $slug): TelegraphText
    {
        return unserialize(file_get_contents($slug));
    }

    // обновляет данные в файле
    public function update(string $slug, TelegraphText $updatedObject): void
    {
        file_put_contents($slug, serialize($updatedObject));
    }

    // удаляет файл-объект из хранилища
    public function delete(string $slug): void
    {
       unlink($slug);
    }

    // возвращает массив со всеми объектами в хранилище
    public function list(): array
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
//$file->create($telegraph);
//$file->create($telegraph1);
//$file->delete('test-text1_06.07.2022_2');
$telegraph->text = 'Обновляю текст объекта телеграф для проверки метода update';
//var_dump($telegraph1->slug);
//$file->update($telegraph->slug, $telegraph);
//var_dump($file->read($telegraph->slug));
//var_dump($file->create($telegraph1));
//var_dump($file->list());

//$file->logMessage('Тестирование записи ошибок.');
//$file->logMessage('Произошла ошибка.');
//$file->logMessage('Внимание, будьте бдительны.');
//$file->logMessage('Ошибки это нормально. Не сдавайся.');

//var_dump($file->lastMessages(3));

$handler = function ()
{
    echo "Привет я анонимная функция Handler";
};

//var_dump($handler());

$file->attachEvent('update', 'count');
$file->attachEvent('list', 'array_pop');
$file->attachEvent('read', $handler);
$file->attachEvent('create', 'array_sum');
$file->detouchEvent('list');
var_dump($file->events);
//var_dump($file->list());
