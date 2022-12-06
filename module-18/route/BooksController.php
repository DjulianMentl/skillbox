<?php

class BooksController
{
    protected $bookslist = ['War and peace', 'Harry Potter', 'Crime and punishment'];

    public function list()
    {
        return json_encode($this->bookslist);
    }
}