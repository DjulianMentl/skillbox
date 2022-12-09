<?php

try {
    $connection = new PDO("mysql:host=localhost;dbname=example;charset=utf8", 'root', 'root');

} catch (\PDOException $e) {
    echo $e->getMessage();
}

$stmt = $connection->query("SELECT * FROM user");
$stmt->execute();

while ($result = $stmt->fetch()) {
    print_r($result);
}