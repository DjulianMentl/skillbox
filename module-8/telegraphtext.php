<?php

class TelegraphText
{
    public $title, $text, $author, $slug, $publiched;

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
    public function loadText(): string|false
    {
        if (file_exists($this->slug) && filesize($this->slug) != 0) {
            $storageText = unserialize(file_get_contents($this->slug));

            $this->author = $storageText['author'];
            $this->publiched = $storageText['published'];
            $this->title = $storageText['title'];
            $this->text = $storageText['text'];

            return $this->text;
        }
        return false;
    }
}

$telegraph = new TelegraphText('Evgeniy', 'test-text32.txt');
$telegraph->editText('Заголовок', 'Текст переданный из функции для добавления/редактирования текста');
$telegraph->storeText();
var_dump($telegraph->loadText());