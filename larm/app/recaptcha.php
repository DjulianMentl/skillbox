<?php

$secret = '6LfyySwjAAAAALAkVr-TV71pM5jy2gSwYd3wkqi2';

if (!empty($_POST['g-recaptcha-response'])) {
    $checkCaptcha = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='
        . $secret . '&response=' . $_POST['g-recaptcha-response']));

    $checkCaptcha->success === true ? $isCaptcha = true : $isCaptcha = false;
} else {
    $isCaptcha = false;
}
?>