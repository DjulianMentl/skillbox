<?php

// абстрактный класс для отображения данных
abstract class View
{
    abstract public function displayTextByld($id);
    abstract public function displayTextByUrl($url);
}