<?php

try {
    $connection = new PDO("mysql:host=localhost;dbname=example;charset=utf8", 'root', 'root');

} catch (\PDOException $e) {
    echo $e->getMessage();
}

// Сырые запросы, если не нужно обрабатывать данные от пользователей
//$connection->exec("INSERT INTO user(id, first_name, last_name, email) values(null, 'Grisha', 'Ivanov', 'iva@iva.ru')");

// Стайтмент

////$stmt = $connection->prepare("INSERT INTO user(id, first_name, last_name, email) values(null, :first_name, :last_name, :email)");
//$statementUpdate = $connection->prepare("UPDATE user SET age = :age WHERE id = :id");
//
//$i = 0;
//$j = rand(20, 45);
//$statementUpdate->bindParam('age', $j);
//$statementUpdate->bindParam('id', $i);
//
//while ($i < 11) {
//    $i++;
//    $j = rand(20, 45);
////    $stmt->execute(['first_name' => "Name{$i}", 'last_name' => "LastName{$i}", 'email' => "email{$i}@ya.ru",]);
//    $statementUpdate->execute();
//}

// Обновление данных в таблице
//$statementUpdate = $connection->prepare("UPDATE user SET email = :email WHERE id = :id");
//$statementUpdate->execute(['email' => 'today@today.ru', 'id' => 4,]);

// Транзакции

$stmtInsertOrders = $connection->prepare("INSERT INTO `orders`(`id`, `user_id`, `order_details`, `order_date`) VALUES (null, :userid, :details, :date)");
$updateUser = $connection->prepare("UPDATE user SET orders_number = :ordersNumber WHERE id = :id");
$getUserOrdersNumber = $connection->prepare("SELECT orders_number FROM user WHERE id = :id");

$userId = 1;

$getUserOrdersNumber->execute(['id' => $userId]);
$ordersNumber = $getUserOrdersNumber->fetchColumn(0);
//echo 'OrdersNumber = ' . $ordersNumber;

$connection->beginTransaction();
try {
    $stmtInsertOrders->execute(['userid' => $userId, 'details' => 'Order text', 'date' => (new \DateTime())->format('Y-m-d H:i:s')]);
    echo 'Inserted Id : ' . $connection->lastInsertId();
    $updateUser->execute(['id' => $userId, 'ordersNumber' => $ordersNumber + 1]);
    $connection->commit();

} catch (\Exception $e) {
    echo 'RollBack';
    $connection->rollBack();
}
