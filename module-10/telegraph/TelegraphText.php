<?php

class TelegraphText
{
    public $title;// заголовок текста
    public $text;// текст
    public $author;// имя автора
    public $slug;// уникальное имя файла, в котором хранятся данные
    public $publiched;// дата и время последнего изменения текста

    public function __construct(string $author, string $slug)
    {
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
    public function storeText(): void
    {
        $storageText = [
            'author' => $this->author,
            'published' => $this->publiched,
            'title' => $this->title,
            'text' => $this->text,
        ];
        file_put_contents($this->slug, serialize($storageText));
    }

    //загрузка текста из файла в объект
    public function loadText(): ?string
    {
        if (file_exists($this->slug) && filesize($this->slug) != 0) {
            $storageText = unserialize(file_get_contents($this->slug));

            $this->author = $storageText['author'];
            $this->publiched = $storageText['published'];
            $this->title = $storageText['title'];
            $this->text = $storageText['text'];

            return $this->text;
        }
        return null;
    }
}

$telegraph1 = new TelegraphText('Evgeniy', 'test-text1');
$telegraph1->editText('Заголовок', 'Текст переданный из функции для добавления/редактирования текста');
$telegraph = new TelegraphText('Evgeniy2', 'test-text1');
$telegraph->editText('Заголовок2', '222222fsdfs22sgsdb2222gvdvb222222xvsdv');
//$telegraph->storeText();
//var_dump($telegraph->loadText());
//var_dump($telegraph);
