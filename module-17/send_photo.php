<?php

session_start();

?>
</pre>
<!<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Отправка фотографий</title>
</head>
<body>
<form name="sendPhoto" action="./send_photo.php" method="post" enctype="multipart/form-data">
    <input type="file" name="photoToUpload">
    <input type="submit" name="sendFile" value="Отправить">
</form>
</body>
</html>
<pre>
<?php

    //  Инициализируем ключи 'success-upload', 'names-upload-files' в массиве $_SESSION
    if (!isset($_SESSION['success-upload']) && !isset($_SESSION['names-upload-files'])) {

        $_SESSION['success-upload'] = 0;
        $_SESSION['names-upload-files'] = [];

    // Проверяем отправлялась ли форма и является ли файл изображением
    } elseif (
            isset($_POST['sendFile'])
            && ($_FILES['photoToUpload']['size'] > 0)
            && getimagesize($_FILES['photoToUpload']['tmp_name'])
    ) {

        // Инициализируем переменные содержащие информацию о типе файла и его размере
        $checkImages = mime_content_type($_FILES['photoToUpload']['tmp_name']);
        $sizeImages = $_FILES['photoToUpload']['size'];

        // Если загружаемый файл jpeg || png и его размер < 2Mb загружаем его на сервер
        if ($sizeImages < 2097152 && ($checkImages == "image/jpeg" || $checkImages == "image/png")) {

            // Перемещаем файл в папку /images/
            try {
                $filename = basename($_FILES['photoToUpload']['name']);
                // Если файла с таким именем не существует, то производим запись в каталог /images/
                if (!file_exists('./images/' . $filename)) {
                    move_uploaded_file($_FILES['photoToUpload']['tmp_name'], './images/' . $filename);
                    header('Location: '.'./images/' . $filename);
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            // В случае успешной загрузки заносим имя загруженного файла в массив
            $_SESSION['names-upload-files'][] = $filename;

            // Если в массиве с именами файлов больше 1 элемента, то выполняем проверку.
            // Если такой файл уже загружали, выводим сообщение и обнуляем счетчик
            if (count($_SESSION['names-upload-files']) > 1) {
                foreach ($_SESSION['names-upload-files'] as $namesUploadFile) {
                    if ($namesUploadFile == $filename) {
                        $_SESSION['success-upload']++;
                    }
                }
                if ($_SESSION['success-upload'] > 1) {
                    echo 'Вы уже загружали этот файл';
                    $_SESSION['names-upload-files'] = array_unique($_SESSION['names-upload-files']);
                }
                $_SESSION['success-upload'] = 0;
            }
        } else {
            echo 'Файл больше 2 Мб или не является картинкой';
        }
    }
