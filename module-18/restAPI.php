<?php

class User {
    public $email;
    public $nickName;
    public $name;
    public $age;
    public $id;

    public function __construct(string $email, string $nickName, string $name, string $age)
    {
        $this->email = $email;
        $this->nickName = $nickName;
        $this->name = $name;
        $this->age = $age;
        $this->id = rand(1, 100);
    }
}

class Storage
{
    const FILE_PATH = './users.json';
    public $objectsList = [];

    // Сначала читаем файл, а потом добавляем новое значение и записываем
    public function __construct()
    {
        $this->read();
    }
    // Запись в файл
    public function store()
    {
        file_put_contents(self::FILE_PATH, json_encode($this->objectsList));
    }
    // Чтение из файла
    public function read()
    {
        if (file_exists(self::FILE_PATH)) {
            $this->objectsList = json_decode(file_get_contents(self::FILE_PATH));
        }
    }
}

class UserStorage extends Storage
{
    public function addUser()
    {
        $this->objectsList[] = new User($_POST['email'], $_POST['nickname'], $_POST['name'], $_POST['age']);
        $this->store();
    }

    public function deleteUser(string $id)
    {
        foreach ($this->objectsList as $key => $user) {
            if ($user->id === intval($id)) {
                unset($this->objectsList[$key]);
                $this->store();
                break;
            }
        }
    }

    public function updateUser($id)
    {
        parse_str(file_get_contents('php://input'), $PUT);
        foreach ($this->objectsList as $key => $user) {
            if ($user->id === intval($id)) {
                $this->objectsList[$key]->email = $PUT['email'] ?? $this->objectsList[$key]->email;
                $this->objectsList[$key]->nickName = $PUT['nickname'] ?? $this->objectsList[$key]->nickname;
                $this->objectsList[$key]->name = $PUT['name'] ?? $this->objectsList[$key]->name;
                $this->objectsList[$key]->age = $PUT['age'] ?? $this->objectsList[$key]->age;
                $this->store();
                break;
            }
        }
    }

    public function getUser(string $id): ?string
    {
        foreach ($this->objectsList as $user) {
            if ($user->id === intval($id)) {
                return json_encode($user);
            }
        }
        return null;
    }

    public function getUserList(): string
    {
        return json_encode($this->objectsList);
    }
}

$userStorage = new UserStorage();

// C - POST /user.php
// R - GET /user.php?id=1
// U - PUT /user.php
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
        $userStorage->updateUser($_GET['id']);
        break;
     case 'DELETE' :
         $userStorage->deleteUser($_GET['id']);
         break;
 }

// var_dump($userStorage->getUserList());