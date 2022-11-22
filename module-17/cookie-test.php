<?php

//setcookie('test-cookie', 'this is my first cookie');

if (isset($_POST['username']) && !empty($_POST['username'])) {
    setcookie('form-sent', 1);
}
//var_dump($_COOKIE);

if (isset($_COOKIE['form-sent']) && $_COOKIE['form-sent'] == 1) {
    echo 'Форма уже отправлена' .PHP_EOL;
} else {

?>

<!<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test cookie</title>
</head>
<body>
<form method="post" action="./cookie-test.php">
    <label>Ваше имя: </label>
    <input type="text" name="username">
    <input type="submit" value="Отправить">
</form>
</body>
</html>

<?php } ?>
