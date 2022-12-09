<?php
try {
    $connection = new PDO("mysql:host=localhost;dbname=example;charset=utf8", 'root', 'root');

} catch (\PDOException $e) {
    echo $e->getMessage();
}

$stmt = $connection->prepare('SELECT * FROM user');
$queryResult = $stmt->execute();

$dataResult = $stmt->fetch();

print_r($dataResult);