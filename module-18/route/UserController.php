<?php

class UserController
{
    protected $userlist = ['Ivan', 'Petr', 'Nikolay', 'Geka',];

    public function list()
    {
        return json_encode($this->userlist);
    }
}