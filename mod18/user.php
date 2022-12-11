<?php
phpinfo();
class User
{
    public $email;
    public $name;
    public $nickname;
    public $age;
    public $id;

    public function __construct($email, $name, $nickname, $age)
    {
        $this->email = $email;
        $this->name = $name;
        $this->nickname = $nickname;
        $this->age = $age;
        $id = rand(1, 100);
    }
}

class Storage
{
    const FILE_PATH = './users.json';
    public $objectsList = [];

    public function store()
    {
        file_put_contents(self::FILE_PATH, json_encode($this->objectsList));
    }

    public function read()
    {
        if (file_exists(self::FILE_PATH)) {
            $this->objectsList = file_get_contents(json_decode(self::FILE_PATH));
        }
    }
}

class UserStorage extends Storage
{
    public function addUser()
    {
        $user = new User($_POST['email'], $_POST['name'], $_POST['nickname'], $_POST['age']);
        $this->objectsList[] = $user;
    }

    public function deleteUser($id)
    {
        foreach ($this->objectsList as $key => $user) {
            if ($user->id === intval($id)) {
                unset($this->objectsList[$key]);
                break;
            }
        }
    }

    public function updateUser()
    {
        foreach ($this->objectsList as $key => $user) {
            if ($user->id === $_POST['id']) {
                $this->objectsList[$key]->email = $_POST['email'];
                $this->objectsList[$key]->name = $_POST['name'];
                $this->objectsList[$key]->nickname = $_POST['nickname'];
                $this->objectsList[$key]->age = $_POST['age'];
                break;
            }
        }
    }

    public function getUser($id)
    {
        foreach ($this->objectsList as $key => $user) {
            if ($user->id === intval($id)) {
                return json_encode($user);
            }
        }
        return null;
    }

    public function getUserList()
    {
        return json_encode($this->objectsList);
    }
}

$userStorage = new UserStorage();

// C - POST /user.php
// R - GET  /user.php?id=1
// U - PUT  / /user.php
// D - DELETE /user.php?id=1
// R all - GET /user.php

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST' :
        $userStorage->addUser();
        break;
    case 'GET' :
        isset($_GET['id']) ? $userStorage->getUser($_GET['id']) : $userStorage->getUserList();
        break;
    case 'PUT' :
        $userStorage->updateUser();
        break;
    case 'DELETE' :
        $userStorage->deleteUser($_GET['id']);
        break;
}
