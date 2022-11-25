<?php
session_start();

require_once './app/dbConnect.php';

if ($_SESSION['isAuthorized']) {

    // Получаем данные профиля из базы
    $idProfile = $_SESSION['passwordDB'];
    //Получаем данные пользователя
    $stmt = $connection->prepare("SELECT * FROM users WHERE id =  $idProfile");
    $stmt->execute();
    $profile = $stmt->fetch();

    // Изменяем имя в базе данных
    if (isset($_POST['changeName']) && !empty($_POST['newName'])) {
        $newName = $_POST['newName'];
        $stmtUpdate = $connection->prepare("UPDATE `users` SET `name` = :name WHERE `users`.`id` = :id");
        $stmtUpdate->execute(['name' => $newName, 'id' => $idProfile]);
    }

    // Редактируем телефон
    if (isset($_POST['changeTel']) && !empty($_POST['newTel'])) {
        $newTel = $_POST['newTel'];
        $stmtUpdate = $connection->prepare("UPDATE `users` SET `tel` = :name WHERE `users`.`id` = :id");
        $stmtUpdate->execute(['name' => $newTel, 'id' => $idProfile]);
    }

    // Редактируем телефон
    if (isset($_POST['changeEmail']) && !empty($_POST['newEmail'])) {
        $newEmail = $_POST['newEmail'];
        $stmtUpdate = $connection->prepare("UPDATE `users` SET `email` = :name WHERE `users`.`id` = :id");
        $stmtUpdate->execute(['name' => $newEmail, 'id' => $idProfile]);
    }

    // Редактируем пароль
    if (isset($_POST['changePass']) && !empty($_POST['newPass'])) {
        $newPass = $_POST['newPass'];
        $stmtUpdate = $connection->prepare("UPDATE `users` SET `password` = :name WHERE `users`.`id` = :id");
        $stmtUpdate->execute(['name' => $newPass, 'id' => $idProfile]);
    }

} else {
    header('Location: ' . "/larm/");
}

//$nameFieldDB = ['name', 'tel', 'email', 'password'];

?>

<!<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Профиль пользователя</title>
</head>
<body>
    <h1>Профиль</h1>
    <?php
    foreach ($profile as $key => $ProfileField) {

        switch ($key) {
            case 'name': ?>
                <p>Имя: <?=$ProfileField?></p>
                <form method="post">
                    <input type="text" name="newName" maxlength="25">
                    <input type="submit" name="changeName" value="Изменить имя">
                </form>
                <?php break;
            case 'tel': ?>
                <p>Телефон: <?=$ProfileField?></p>
                <form method="post">
                    <input type="tel" name="newTel" maxlength="11">
                    <input type="submit" name="changeTel" value="Изменить телефон">
                </form>
                <?php break;
            case 'email': ?>
                <p>Email: <?=$ProfileField?></p>
                <form method="post">
                    <input type="email" name="newEmail" maxlength="25">
                    <input type="submit" name="changeEmail" value="Изменить email">
                </form>
                <?php break;
            case 'password': ?>
                <p>Пароль: <?=$ProfileField?></p>
                <form method="post">
                    <input type="password" name="newPass" maxlength="25">
                    <input type="submit" name="changePass" value="Изменить пароль">
                </form>
                <?php break;
        }
    } ?>
</body>
</html>
