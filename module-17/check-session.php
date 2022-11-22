<?php

session_start();
$sent = 0;
var_dump($_POST);
if (!isset($_SESSION['sent'])) {
    $_SESSION['sent'] = 0;
} else {
    if (isset($_POST['form-checker'])) {
        $_SESSION['sent']++;
        session_destroy();
    }
}

$sent = $_SESSION['sent'];
var_dump($_POST);
?>

<!<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Session test</title>
</head>
<body>
<p>Кнопку нажали <?=$sent;?> раз</p>
<form action="check-session.php" method="post" name="test">
    <input type="hidden" name="form-checker">
    <input type="submit" value="Отправить">
</form>
</body>
</html>
