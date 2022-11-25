<?php
// Код для проверки введенных значений при регистрации со значениями в базе денных
try {
    $stmtName = $connection->prepare('SELECT `name` FROM users WHERE name LIKE :name');
    $stmtTel = $connection->prepare('SELECT `tel` FROM users WHERE tel LIKE :tel');
    $stmtEmail  = $connection->prepare('SELECT `email` FROM users WHERE email LIKE :email');

    $stmtName->bindValue('name', $name);
    $stmtTel->bindValue('tel', $tel);
    $stmtEmail->bindValue('email', $email);

    $stmtName->execute();
    $stmtTel->execute();
    $stmtEmail->execute();

// Если совпадает с базой true, иначе false
    $isRepeatName = $stmtName->fetchAll() ? true : false;
    $isRepeatTel = $stmtTel->fetchAll() ? true : false;
    $isRepeatEmail = $stmtEmail->fetchAll() ? true : false;
} catch(PDOException $e) {
    echo $e->getMessage();
}

