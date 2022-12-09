<?php

class User
{
    private $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO("mysql:host=localhost;dbname=homework;charset=utf8", 'root', 'root');
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function create(array $userData): void
    {
        $stmtInsertUser = $this->connection->prepare(
            "INSERT INTO `users`(`id`, `email`, `first_name`, `last_name`, `age`, `date_created`)
                    VALUES (null, :email, :first_name, :last_name, :age, :date_created)");
        $stmtInsertUser->execute($userData);
    }

    public function update(array $updateDate, int $id): void
    {
        $sql = "UPDATE users SET ";
        foreach ($updateDate as $key => $value) {
            $sql .= $key . " = " . ":" . $key . ", ";
        }
        $sql = trim($sql, " ");
        $sql = rtrim($sql, ",");

        $sql .= " WHERE id = $id";

        $stmtUpdateUser = $this->connection->prepare($sql);
        $stmtUpdateUser->execute($updateDate);
    }

    public function delete(int $id): void
    {
        $stmtDelete = $this->connection->prepare("DELETE FROM users WHERE id = $id");
        $stmtDelete->execute();
    }

    public function list(): array
    {
        $stmt = $this->connection->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

$newUser[0] = ['email' => 'mais@jkd.ru', 'first_name' => 'Mais', 'last_name' => 'Nevskiy', 'age' => 31, 'date_created' => (new DateTime())->format('Y-m-d H:i:s')];
$newUser[1]= ['email' => 'Sasha@jkd.ru', 'first_name' => 'Sasha', 'last_name' => 'Hrenko', 'age' => 44, 'date_created' => (new DateTime())->format('Y-m-d H:i:s')];
$newUser[2] = ['email' => 'Serg@jkd.ru', 'first_name' => 'Serg', 'last_name' => 'Skoriy', 'age' => 27, 'date_created' => (new DateTime())->format('Y-m-d H:i:s')];
$newUser[3] = ['email' => 'Gekae@jkd.ru', 'first_name' => 'Gekae', 'last_name' => 'Kolobkov', 'age' => 61, 'date_created' => (new DateTime())->format('Y-m-d H:i:s')];
$newUser[4] = ['email' => 'Pavel@jkd.ru', 'first_name' => 'Pavel', 'last_name' => 'Solncev', 'age' => 58, 'date_created' => (new DateTime())->format('Y-m-d H:i:s')];
$updateUser = ['last_name' => 'Greenkin'];
$updateUserId = 1;
$deleteUserId = 2;

$userObj = new User();
//foreach ($newUser as $item) {
//    $userObj->create($item);
//}
//$userObj->update($updateUser, $updateUserId);
//$userObj->delete($deleteUserId);

//print_r($userObj->list());