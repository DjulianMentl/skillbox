<?php

require_once '../app/functions.php';
require_once '../app/recaptcha.php';
require_once '../app/dbConnect.php';

if (isset($_POST['sendAuthForm'])) {

    $login = htmlspecialchars(trim($_POST['login']));
    $password = htmlspecialchars(trim($_POST['passwordAuth']));

    //Проверка логина
    // Если $login email, то ищем в базе по полю email
    if (isValidateEmail($login)) {

        // Проверять с полем email из базы
        $stmt = $connection->prepare("SELECT `id`,`email` FROM users WHERE email = ?");
        $stmt->execute(["$login"]);
        $email = $stmt->fetch();
    // Если логин содержит только цифры, обрабатываем как телефон
    } elseif (isValidateTel($login)) {

        // Проверять с полем телефон из базы
        $stmt = $connection->prepare("SELECT `id`,`tel` FROM users WHERE tel = ?");
        $stmt->execute(["$login"]);
        $tel = $stmt->fetch();
    } else {
        $isLogin = false;
    }

    // Флаги, чтоб вывести сообщение для данных прошедших первичную валидацию
    // но не найденных в базе
    $isLoginEmail = $email ?? null;
    $isLoginTel = $tel ?? null;

    // Первичная валидация и поиск пароля в базе
    if (isLengthPassword($password) && isValidatePassword($password)) {

        // Проверяем введенный пароль на совпадение в базе
        $stmt = $connection->prepare("SELECT `id`,`password` FROM users WHERE password = ?");
        $stmt->execute(["$password"]);
        $passwordDB = $stmt->fetch();

        // Если в базе есть такой пароль и логин или емайл, а также введена капча
        if ($passwordDB && ($isLoginTel || $isLoginEmail)  && isset($isCaptcha) && $isCaptcha) {
            // Сравниваем id, чтоб убедиться, что пароль и логин от одинаковой учетной записи
            // Если все хорошо перенаправляем на страницу профиля
//            isset($email['id']) && $passwordDB['id'] === $email['id']
//            || isset($tel['id']) && $passwordDB['id'] ===  $tel['id']
//            ? header('Location: ' . "../profile.php") : $passwordDB = false;

            // Вариант с сессией
            if (isset($email['id']) && $passwordDB['id'] === $email['id']
                || isset($tel['id']) && $passwordDB['id'] ===  $tel['id']) {

                session_start();
                $_SESSION['isAuthorized'] = true;
                $_SESSION['passwordDB'] = $passwordDB['id'];
                header('Location: ' . "../profile.php");
            }
        }
    }
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../style/style.css" rel="stylesheet" type="text/css">
    <title>Авторизация</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <div  class="fixed-container">
        <h1>Авторизуйтесь</h1>
        <form class="reg-form" action="" name="authForm" method="post">

            <label for="login">Введите телефон или email</label>
            <input type="text" id="login" name="login" maxlength="25" value="<?=$_POST['login'] ?? '';?>" required>
            <?php if (isset($isLogin) && !$isLogin) {?>
                <span>Некорректный телефон или email</span>
            <?php } elseif (isset($isLoginEmail) && !$isLoginEmail) {?>
                <span>Пользователь с таким email не зарегистрирован</span>
            <?php } elseif (isset($isLoginTel) && !$isLoginTel) {?>
                <span>Пользователь с таким телефоном не зарегистрирован</span>
            <?php } ?>
            <label for="passw">Введите пароль</label>
            <input type="password" id="passw" name="passwordAuth" maxlength="25" required>
            <?php if (isset($password)) {
                if (!isLengthPassword($password)) {?>
                    <span>Пароль должен быть от 8 до 25 символов</span>
                <?php } elseif (!isValidatePassword($password)) {?>
                    <span>Пароль может содержать только латинские буквы, цифры и символы _.?*!-</span>
                <?php } elseif (!$passwordDB) {?>
                    <span>Пароль не подходит</span>
                <?php }
                }?>

                <div class="g-recaptcha" data-sitekey="6LfyySwjAAAAAOgkX55s8nRCVlHNL5OjvV2rY_pH"></div>
                <?php if (isset($isCaptcha) && !$isCaptcha) {?>
                    <span>* Обязательно поставьте галочку</span>
                <?php } ?>

            <input type="submit" name="sendAuthForm" value="Войти">
        </form>
    </div>
</body>
</html>
