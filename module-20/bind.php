<?php

try {
    $connection = new PDO("mysql:host=localhost;dbname=example;charset=utf8", 'root', 'root');

} catch (\PDOException $e) {
    echo $e->getMessage();
}

$stmt = $connection->prepare('SELECT * FROM user WHERE id = :id or email LIKE :email');
//$stmt->execute(['id' => 2, 'email' => 'vanvvan@nae.ru']);

$id = 3;
$email = 'geka@geka.ru';

$stmt->bindValue('id', $id);
$stmt->bindValue('email', $email);

$stmt->execute();
$result = $stmt->fetchAll();

print_r($result);