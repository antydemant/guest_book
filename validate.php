<?php

$name = stripslashes(trim(htmlspecialchars($_POST['name'],ENT_QUOTES)));
$email = stripslashes(trim(htmlspecialchars($_POST['email'],ENT_QUOTES)));
$msg = stripslashes(trim(htmlspecialchars($_POST['msg'],ENT_QUOTES)));
function validate()
{
    global $errors, $email;

    if (!isset($_POST['name']) || empty($_POST['name'])) {
        $errors['name'] = 'Введите имя !';
     }
    if (!isset($_POST['email']) || !strstr($email, '@') || !strstr($email,'.')) {
        $errors['email'] = 'Неверный Email!';
    }
    if (!isset($_POST['msg']) || empty($_POST['msg'])) {
        $errors['msg'] = 'Введите msg!';
    }
    if ($errors)
        return false;
    else
        return true;
}
?>
