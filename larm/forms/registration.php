<?php

require_once '../app/functions.php';
require_once '../app/dbConnect.php';

// Переменная для скрытия формы после успешной регистрации
$isRegistered = false;
$isValidDate = false;

// Если форма отправлена валидируем данные
if (isset($_POST['regFormSend'])) {
    // Первичная валидация данных от клиента
    // Дополнительная валидация проводится функциями внутри формы
    $name = htmlspecialchars(trim($_POST['name']));
    $tel = htmlspecialchars(trim($_POST['tel']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password1 = htmlspecialchars(trim($_POST['password1']));
    $password2 = htmlspecialchars(trim($_POST['password2']));

    // Если все данные введены верно передаем их в базу и выводим сообщение об успешной регистрации
    (isValidateName($name)
    && isValidateTel($tel)
    && isValidateEmail($email)
    && isPasswordsMatch($password1, $password2)
    && isLengthPassword($password1)
    && isValidatePassword($password1)) ? $isValidDate = true : $isValidDate = false;

    if ($isValidDate) {
        // Если все введенные данные корректны, то сравниваем данные в базе
        // с введенными данными (имя, телефон и эл. почту)
        require '../app/dbCheckRepeat.php';

        // Если повторы в базе не найдены, ставим флаг успешной регистрации
        // И отправляем данные в базу
        if (!$isRepeatName && !$isRepeatTel && !$isRepeatEmail) {
            $isRegistered = true;

            try {
                $stmt = $connection->prepare("INSERT INTO users(id, name, tel, email, password) values(null, :name, :tel, :email, :password)");
                $stmt->execute(['name' => $name, 'tel' => $tel, 'email' => $email, 'password' => $password1]);

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link href="../style/style.css" rel="stylesheet" type="text/css">
    <title>Форма регистрации</title>
</head>
<body>
    <div class="fixed-container" style="height: 100%">
    <?php if (!$isRegistered) {?>
        <h1>Форма регистрации</h1>
        <form  class="reg-form" action="<?=htmlspecialchars($_SERVER['PHP_SELF']);?>" name="regForm" method="post">

            <label for="name">Введите имя:</label>
            <input type="text" id="name" name="name" maxlength="25" value="<?= $_POST['name'] ?? '';?>" required>
            <small>От 3-х до 25 символов</small>
            <?php if (isset($name) && !isValidateName($name)) {?>
                <span>Разрешены только латинские буквы, цифры</span>
            <?php } elseif ($isValidDate && $isRepeatName) {?>
                <span>Такое имя уже существует</span>
            <?php }?>
            <label for="tel">Введите телефон:</label>
            <input type="tel" id="tel" name="tel" maxlength="11" value="<?= $_POST['tel'] ?? '';?>"
                   pattern="8[0-9]{10}" required>
            <small>Формат:81231231212</small>
            <?php if (isset($tel) && !isValidateTel($tel)) {?>
                <span>Телефон введен неверно</span>
            <?php } elseif ($isValidDate && $isRepeatTel) {?>
                <span>Такой телефон уже существует</span>
            <?php }?>

            <label for="email">Введите e-mail:</label>
            <input type="email" id="email" name="email" value="<?= $_POST['email'] ?? '';?>" required>
            <?php if (isset($email) && !isValidateEmail($email)) {?>
                <span>Email введен неверно</span>
            <?php } elseif ($isValidDate && $isRepeatEmail) {?>
                <span>Такой email уже существует</span>
            <?php }?>

            <label for="password1">Введите пароль:</label>
            <input type="password" id="password1" name="password1" maxlength="25" required>
            <input type="password" name="password2" maxlength="25" required>

            <?php
            if (isset($password1) && isset($password2)) {
                if (!isPasswordsMatch($password1, $password2)) {?>
                    <span>Пароли не совпадают</span>
                <?php } elseif (!isLengthPassword($password1)) {?>
                    <span>Длина пароля должна быть от 8 до 25 символов</span>
                <?php } elseif (!isValidatePassword($password1)) {?>
                    <span>Пароль может содержать только латинские буквы, цифры и символы _.?*!-</span>
                <?php }
            }?>

            <input class="button-login" type="submit" name="regFormSend" value="Отправить">
        </form>
    <?php } else {?>
        <div class="fixed-container">
            <p>Поздравляем!</p>
            <p>Вы успешно зарегистрировались</p>
            <div class="button-container">
                <button class="button-sign" onclick="window.location.href = 'authorization.php';">Войти</button>
            </div>
        </div>
    <?php }?>
    </div>
</body>
</html>
