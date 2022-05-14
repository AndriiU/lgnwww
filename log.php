<?php
include 'header.php';

if ($_GET['confirm']){
    
    include 'db.php';
    $login = mysqli_real_escape_string($db, $_GET['login']);

    $row = mysqli_fetch_assoc(mysqli_query($db, "SELECT `secret` FROM `users` WHERE `login` = '$login';"));
    if(!$row){
        exit('Обліковий запис не знайдено');
    }    

    require_once 'GoogleAuthenticator.php';
    $ga = new PHPGangsta_GoogleAuthenticator();
    $checkResult = $ga->verifyCode($row['secret'], $_GET['code'], 2); // 2 = 2*30sec clock tolerance
    if ($checkResult) {
        exit('Код введено вірно');
    } else {
        exit('Код введено невірно');
    }
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
                <p><input type="text" name="code" placeholder="Введіть одноразовий пароль"></p>
                <!-- <p><input type="hidden" name="login" value="<?=$login?>"></p> -->
                <p><input type="hidden" name="login" value="<?php echo $_GET['login']; ?>"></p>
                <p><input type="submit" name="confirm" value="Увійти"></p>
        </form>
    </body>
</html>