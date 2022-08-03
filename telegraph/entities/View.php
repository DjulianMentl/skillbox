<?php

// абстрактный класс для отображения данных
abstract class View
{
    public $storage;

    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
    }

    abstract public function displayTextByld($id);
    abstract public function displayTextByUrl($url);
}