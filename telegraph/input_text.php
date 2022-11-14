<?php
// Подкючаем PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Загружаем Composer autoloader и автозагрузку классов и интерфейсов
require_once __DIR__ . '/autoload.php';

// Оформление и вывод сообщений пользовательских исключений на экран
function showLenghtTextExceptionDisplay(Throwable $e): void
{
    echo '<div style=" padding: 100px; font-weight: bold; background-color: pink; width: 20%;">' . $e->getMessage() . '</div>';
}
set_exception_handler('showLenghtTextExceptionDisplay');

// Переменная-индикатор статуса отправки на эл. почту
$sendEmailStatus = '';

if (isset($_POST['sendText'])) {

    // В целях безопасности обрабатываем получаемые данные
    $author = trim(htmlspecialchars($_POST['authorName']));
    $text = trim(htmlspecialchars($_POST['text']));
    $email = trim(htmlspecialchars($_POST['email']));

    // Если заполнены автор и текст, создать объект класса TelegraphText и заполняем его данными
    if (!empty($author) && !empty($text)) {
        $contentFromForm = new TelegraphText($author, 'text-from-form');
        $contentFromForm->text = $text;

        // Создаем объект класса FileStorage и с помощью его метода create() записываем данные в файл
        $storage = new FileStorage();
        $storage->create($contentFromForm);

        // Если заполнен email отправляем письмо на указанный адрес эл. почты
        // Проверяем введенный адрес на содержание символа @
        if (empty($email) || !preg_match('/@/', $email)) {
            $incorrectEmail = true;
        } else {
            // Создать экземпляр; передача `true` разрешает исключения
            $mail = new PHPMailer(true);

            try {

                //настройка SMTP сервера yandex
//                $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->isSMTP();
                $mail->SMTPAuth   = true;
                $mail->CharSet = 'UTF-8';
                $mail->Host       = 'smtp.yandex.ru';
                $mail->Username   = 'hakmakgo2@yandex.ru';
                $mail->Password   = 'solncevsem33';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port       = 465;

                //отправитель
                $mail->setFrom('hakmakgo2@yandex.ru', 'Sender');
                //получатель
                $mail->addAddress($email, $author);

                //Отправка
                $mail->isHTML(true);
                $mail->Subject = $author . 'шлет привет';
                $mail->Body = $text;

                // Присваиваем статуст в зависимости от результата отправки
                $mail->send() ? $sendEmailStatus = 'succes' : $sendEmailStatus = 'error';

            } catch (Exception $e) {

                $sendEmailStatus = 'error';

                // При выбросе исключения записываем ошибку в лог файл
                $date = new DateTime();
                file_put_contents('logs-send-email.txt', $date->format('Y.m.d H:i:s') . $mail->ErrorInfo . PHP_EOL, FILE_APPEND);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Форма отправки текста</title>
    <link href="style/style-form.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="send-status">
        <?php if ($sendEmailStatus === "succes") {?>
            <div class="send-succes">
                <p>Сообщение отправлено</p>
            </div>
        <?php } elseif ($sendEmailStatus === 'error') {?>
            <div class="send-failed">
                <p>Ошибка отправки</p>
            </div>
        <?php } ?>
    </div>
    <h2>Форма отправки текста в "Телеграф"</h2>
    <div class="text-send-form">
        <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div>
                <label for="authorName">Введите имя:</label>
                <input type="text" name="authorName" id="authorName" required>
            </div>
            <div>
                <labeL for="text">Введите текст:</labeL>
                <textarea name="text" id="text" required></textarea>
            </div>
            <div>
                <label for="email">Введите e-mail:</label>
                <input type="email" name="email" id="email">
                <?php
                // Проверка введенного адреса эл. почты
                if (isset($incorrectEmail)) {?>
                    <p>Введен некорректный e-mail</p>
                <?php } ?>
            </div>
            <button type="submit" name="sendText">Отправить</button>
        </form>
    </div>
</body>
</html>