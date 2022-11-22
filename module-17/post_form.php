<?php
if (isset($_POST['sendText'])) {
    if (!empty($_POST['title']) && !empty($_POST['author']) && !empty($_POST['content'])) {
        $newArticle = [
            'title' => $_POST['title'],
            'author' => $_POST['author'],
            'content' => $_POST['content'],
        ];

        file_put_contents('new_article.json', json_encode($newArticle) . "\n", FILE_APPEND);

    } else {
        echo 'Заполните все поля' . PHP_EOL;
    }
}
?>

<html>
<head>
    <title>Отправить статью</title>
</head>
<body>
<h1>Text article</h1>
<form method="post" name="post_article" action="post_form.php">
    <label>Заголовок <input type="text" name="title"></label><br>
    <label>Автор <input type="text" name="author"></label><br>
    <label>Статья <textarea name="content"></textarea></label><br>
    <input type="submit" name="sendText" value="Отправить">
</form>
</body>
</html>
