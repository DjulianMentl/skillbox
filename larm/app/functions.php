<?php

/**
 * Валидация клиентских данных из поля "Имя"
 * @param string $name
 * @return bool
 */
function isValidateName(string $name): bool
{
    return preg_match('/^[a-zA-Z0-9_.-]{3,25}$/', $name);
}
/**
 * Валидация клиентских данных из поля "Телефон"
 * @param string $tel
 * @return bool
 */
function isValidateTel(string $tel): bool
{
    return preg_match('/^8{1}[0-9]{10}$/', $tel);
}

/**
 * Валидация клиентских данных из поля "Email"
 * @param string $email
 * @return bool
 */
function isValidateEmail(string $email): bool
{
    $patternEmail = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/';
    return preg_match($patternEmail, $email);
}

/**
 * Проверяет совпадают ли пароли введенные при регистрации
 * @param string $password1
 * @param string $password2
 * @return bool
 */
function isPasswordsMatch(string $password1, string $password2): bool
{
    return $password1 === $password2;
}

/**
 * Проверяет длину пароля
 * @param string $password
 * @return bool
 */
function isLengthPassword(string $password): bool
{
    $lengthPassword = strlen($password);
    return $lengthPassword >= 8 && $lengthPassword <= 25;
}

/**
 * Проверяет символы входящие в пароль
 * @param string $password
 * @return bool
 */
function isValidatePassword(string $password): bool
{
    return preg_match('/^[a-zA-Z0-9_.?*!-]{8,20}$/', $password);
}
?>