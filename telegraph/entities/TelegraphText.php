<?php

// Класс для работы с текстом
class TelegraphText
{
    private $title;// заголовок текста
    private $text;// текст
    private $author;// имя автора
    private $slug;// уникальное имя файла, в котором хранятся данные
    private $publiched;// дата и время последнего изменения текста

    public function __set($name, $value)
    {
        switch ($name) {
            case 'author':
                $this->setAuthor($value);
                break;
            case 'slug':
                $this->setSlug($value);
                break;
            case 'publiched':
                $this->setPubliched($value);
                break;
            case 'text':
                $this->setText($value);
        }
    }

    public function __get($name)
    {
        switch ($name) {
            case 'author':
                return $this->getAuthor();
            case 'slug':
                return $this->getSlug();
            case 'publiched':
                return $this->getPubliched();
            case 'text':
                return $this->getText();
        }
    }

    public function getText(): ?string
    {
        return $this->loadText();
    }

    public function setText(string $text): void
    {
        $this->text = $text;
        $this->storeText();
    }

    public function getPubliched(): string
    {
        return $this->publiched;
    }

    public function setPubliched($publiched): void
    {
        if ($publiched < date("d.m.Y")) {
            echo 'Дата не может быть меньше текущей';
            return;
        }
        $this->publiched = $publiched . date(" H:i:s");
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        if (preg_match('/^[a-z0-9-_.]+$/i', $slug)) {
            $this->slug = $slug;
            return;
        }
        echo 'Удалите недопустимые символы' . PHP_EOL;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function setAuthor(string $author): void
    {
        if (strlen($author) > 120) {
            echo 'Имя автора не может быть больше 120 символов.';
            return;
        }
        $this->author = $author;
    }

    public function __construct(string $author, string $slug)
    {
        $this->author = $author;
        $this->slug = $slug;
        $this->publiched = date("d.m.Y H:i:s");
    }

    //добавление/редактирование текста в объекте
    public function editText (string $title, string $text): void
    {
        $textLength = strlen($text);
        if ($textLength >= 1 && $textLength <= 500) {
            $this->text = $text;
        } else {
            throw new Exception('Длина текста должна быть от 1 до 500 символов');
        }
        $this->title = $title;
    }

    //запись массива с данными в файл
    private function storeText(): void
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
    private function loadText(): ?string
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
