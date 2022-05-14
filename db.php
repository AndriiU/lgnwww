<?php

$host = 'kt371968.mysql.tools';
$database = 'kt371968_leg';
$user = 'kt371968_leg';
$password = '4@cgM7h)F5';

$db = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($db));
if (!mysqli_set_charset($db, "utf8")) {
    exit('');
} else {

}
?>