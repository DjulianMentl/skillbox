<pre>
<?php
var_dump($_FILES);

if (isset($_FILES['photo'])) {
    try {
        move_uploaded_file($_FILES['photo']['tmp_name'], __DIR__ . './' . $_FILES['photo']['name']);

?>
    <img src="<?='./' . $_FILES['photo']['name']; ?>" alt="Загруженная картинка">
<?php
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
?>
</pre>
<!<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload file</title>
</head>
<body>
<form action="upload-file.php" name="upFile" method="post" enctype="multipart/form-data">
    <input type="file" name="photo">
    <input type="submit" value="Загрузить">
</form>
</body>
</html>
