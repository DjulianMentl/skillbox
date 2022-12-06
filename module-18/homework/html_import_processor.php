<!<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Форма для URL-адреса</title>
</head>
<body>
    <form method="post" action="html_import_processor.php">
        <label>Введите URL-адрес:</label>
        <input type="url" name="url">
        <input type="submit" name="sendContent" value="Отправить">
    </form>
</body>
</html>

<?php


/**
 * Получение html-кода страницы адрес, которой был введен в форме и возврат данных в формате json
 * @return string
 */
function getContent(string $url): string
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $urlContent = curl_exec($ch);
    curl_close($ch);

    return json_encode($urlContent);
}

// Проверяем форму на отправку и наличие url
if (isset($_POST['sendContent']) && !empty($_POST['url'])) {
    $url = htmlspecialchars($_POST['url']);
    // Получаем контент страницы в json
    $jsonUrlContent = getContent($url);

    $jsonArr = ['raw_text' => $jsonUrlContent];

//    echo json_decode($jsonUrlContent);

    // Отправка JSON в HtmlProcessor.php
    $url = 'http://localhost/skillbox/module-18/homework/HtmlProcessor.php';
    // Настройка запроса для отправки json через POST
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonArr);

    $response = curl_exec($ch);
    curl_close($ch);

    $response ? print_r($response) : http_response_code(500);
}
