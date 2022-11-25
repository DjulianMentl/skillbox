<?php

// Подключение к базе данных
try {
    $host = 'localhost';
    $dbname = 'only';
    $user = 'root';
    $pass = 'root';
    $connection = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
}
catch(PDOException $e) {
    echo $e->getMessage();
}
?>