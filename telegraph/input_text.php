<?php
// подкючаем PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
// загружаем Composer autoloader и автозагрузку классов и интерфейсов
require_once __DIR__ . '/autoload.php';

// Оформление и вывод сообщений пользовательских исключений на экран
function getExceptionDisplay(Throwable $e): void
{
    echo '<div style=" padding: 100px; font-weight: bold; background-color: pink; width: 20%;">' . $e->getMessage() . '</div>';
}
set_exception_handler('getExceptionDisplay');

//переменная-индикатор статуса отправки на эл. почту
$sendEmailStatus = '';
//переменная-индикатор корректного ввода адреса электронной почты
$isEmail = true;

if (isset($_POST['sendText'])) {
    //в целях безопасности обрабатываем получаемые данные
    $authorName = trim(htmlspecialchars($_POST['authorName']));
    $text = trim(htmlspecialchars($_POST['text']));
    $emailAddress = trim(htmlspecialchars($_POST['email']));

    //если введены данные записываем их в файл
    if (! empty($authorName) && ! empty($text)) {
        // сохраняем данные из формы в файл
        $contentFromForm = new TelegraphText($authorName, 'text-from-form');
        $contentFromForm->editText('Заголовок', $text);
        $storage = new FileStorage();
        $storage->create($contentFromForm);

        //если введен email отправляем копию на электронную почту
        if (! empty($emailAddress)) {

            $mail = new PHPMailer(true);

            try {
                $mail->CharSet = 'UTF-8';

                //настройка SMTP сервера yandex
//                $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->isSMTP();
                $mail->SMTPAuth   = true;

                $mail->Host       = 'smtp.yandex.ru';
                $mail->Username   = 'hakmakgo2@yandex.ru';
                $mail->Password   = 'solncevsem3';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port       = 465;

                //отправитель
                $mail->setFrom('hakmakgo2@yandex.ru', 'Sender');
                //получатель
                //проверка введенного адреса на содержание символа @
                preg_match("/@/", $emailAddress) ? $mail->addAddress($emailAddress, 'Recipient') : $isEmail = false;

                //Отправка
                $mail->isHTML(true);
                $mail->Subject = $authorName;
                $mail->Body = $text;
                $mail->send();
                $sendEmailStatus = true;
            } catch (Exception $e) {

                $sendEmailStatus = false;
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
        <?php if ($sendEmailStatus === true) {?>
        <div class="send-succes">Сообщение отправлено</div>
        <?php } elseif ($sendEmailStatus === false) {?>
            <div class="send-failed">Ошибка отправки</div>
        <?php } ?>
    </div>
    <div class="text-send-form">
        <form method="post" action="<?=$_SERVER['PHP_SELF'];?>">
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
                if ($isEmail === false) {?>
                <p>Введен неверный адрес эл. почты</p>
                <?php } ?>
            </div>
            <button type="submit" name="sendText">Отправить</button>
        </form>
    </div>
</body>
</html>