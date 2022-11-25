<?php

?>
<!<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="style/style.css" rel="stylesheet" type="text/css">
    <title>Главная</title>
    <!--
    <style>
        body {
            background-color: #3f3f3f;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .button-conteiner {
            display: flex;
            flex-direction: column;
            width: 200px;
            border: 1px solid #790505;
            border-radius: 5px;

            background-color: #5f6a72;
        }
        .button-login, .button-sign {
            padding: 5px;
            margin: 10px;
            color: #ffffff;
            background-color: #5f6a72;
            border-radius: 5px;
        }
    </style>
    -->
</head>
<body>
    <div class="fixed-container">
<!--        <h1>Авторизуйся или регистрируйся</h1>-->
        <div class="button-container">
            <button class="button-sign" onclick="window.location.href = 'forms/authorization.php';">Войти</button>
            <button class="button-sign" onclick="window.location.href = 'forms/registration.php';">Зарегистрироваться</button>
        </div>
    </div>
</body>
</html>
