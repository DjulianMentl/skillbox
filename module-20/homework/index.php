<?php
require_once __DIR__ . "/User.php";
?>

<!<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Список пользователей</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Имя</th>
                <th>Фамилия</th>
                <th>Email</th>
                <th>Возраст</th>
                <th>Дата</th>
                <th>Edit</th>

            </tr>
        </thead>
        <tbody>
        <?php
            $userArrays = $userObj->list();
            foreach ($userArrays as $user) {?>
            <form action="index.php" method="post">
            <tr>
            <td><?=$user['id']?></td>
            <?php
                foreach (array_unique($user) as $key => $userData) {
                    if ($key === 'id') continue;?>
                    <td><input type="text" name="<?=$key?>" value="<?=$userData?>"></td>
            <?php }?>
                <td>
                    <button type="submit" name="edit_user" value="<?=$user['id'] ?? ''?>">Edit</button>
                    <button type="submit" name="delete_user" value="<?=$user['id'] ?? ''?>">Delete</button>
                </td>
            </tr>
            </form>
        <?php } ?>
        </tbody>
    </table>
    
    <h3>Добавление новых пользователей</h3>
    <div style="margin: 5px">
        <form action="index.php" method="post">
            <input type="hidden" name="id" value="null">

            <div>
                <label>Введите имя:</label>
                <input type="text" name="first_name" required>
            </div>
            <div>
                <label>Введите фамилию:</label>
                <input type="text" name="last_name" required>
            </div>
            <div>
                <label>Введите email:</label>
                <input type="text" name="email" required>
            </div>
            <div>
                <label>Введите возраст:</label>
                <input type="text" name="age" required>
            </div>
            <input type="hidden" name="date_created" value="<?=(new DateTime())->format('Y-m-d H:i:s')?>">
            <input type="submit" name="new_user_form">
        </form>
    </div>
</body>
</html>

<?php

/**
 * Функция для проверки данных введенных при добавлении или редактировании
* @return array
 */
function userDataValidity()
{
    $email = htmlspecialchars($_POST['email']);
    $firstName = htmlspecialchars($_POST['first_name']);
    $lastName = htmlspecialchars($_POST['last_name']);
    $age = htmlspecialchars($_POST['age']);
    $createdDate = htmlspecialchars($_POST['date_created']);

     return ['email' => $email, 'first_name' => $firstName, 'last_name' => $lastName, 'age' => $age, 'date_created' => $createdDate];
}
// Удаление пользователей
if (isset($_POST['delete_user'])) {
    $userObj->delete(intval($_POST['delete_user']));
}

// Обновление информации о пользователях
if (isset($_POST['edit_user'])) {

    $id = intval($_POST['edit_user']);
    $userArrays[$id] = userDataValidity();

    $userObj->update($userArrays[$id], $id);
}

// Добавление новых пользователей
if (isset($_POST['new_user_form'])) {
    $userObj->create(userDataValidity());
}