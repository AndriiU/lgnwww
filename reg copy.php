<?php
include 'header.php';


if ($_GET['enter']){
    include 'db.php';
    $login = mysqli_real_escape_string($db, $_GET['login']);

    if (mysqli_num_rows(mysqli_query($db, "SELECT `secret` FROM `users` WHERE `login` = '$login';"))) {
        exit('Цей логін вже існує');
    }

    require_once 'GoogleAuthenticator.php';
    $ga = new PHPGangsta_GoogleAuthenticator();
    $secret = $ga->createSecret();

    mysqli_query($db, "INSERT `users` (login, secret) VALUES ('$login', '$secret');");

    exit('<p>Секретний ключ: '.$secret.'</p><p><img src="'.$ga->getQRCodeGoogleUrl($login, $secret).'"></p>');
}


?>  

<!DOCTYPE html>
<html>
    <head>
        <title>Авторизація</title>
    </head>
    <body>
        <p>Авторизація</p>
        <form method="get" action="/log.php">
                <p><input type="text" name="login" placeholder="Введіть ваш логін"></p>
                <p><input type="submit" name="enter" value="Продовжити"></p>
        </form>
        <p>Реєстрація</p>
        <form method="get" action="/reg.php">
                <p><input type="text" name="login" placeholder="Введіть ваш логін"></p>
                <p><input type="submit" name="enter" value="Створити аккаунт"></p>
        </form>
    </body>
</html>