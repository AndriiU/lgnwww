<?
include 'header.php';

echo '<div style="margin-top:42px;"></div>';
function _auth(){
    $pass = '<jhcer4thn';
    if ( isset($_POST['pass_value'], $_POST['pass_btn']) ) {
        if ($pass == $_POST['pass_value']) {
            $_SESSION['unique_sdfcdrgbtrhbgfnb'] = true;
        } else {
            $_SESSION['sdfcdrgbtrhbgfnb'] = false;
            echo '<div>Failed password</div>';
        }
    }
    if ($_SESSION['unique_sdfcdrgbtrhbgfnb'] !== true) {
        echo '<form method="POST">'.
        '<div>Enter password:<br /><input type="text" name="pass_value" size="30" /></div>'.
        '<div><input type="submit" value="Enter" name="pass_btn" /></div>'.
        '</form>';
        die();
    }
}

_auth();
$host = 'kt371968.mysql.tools';
$database = 'kt371968_leg';
$user = 'kt371968_leg';
$password = '4@cgM7h)F5';
$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
if (!mysqli_set_charset($link, "utf8")) {
    exit();
} else {
  
}

?>
<style type="text/css">
	label {
    color: #343a40;
}
.link {
	color: #333;
	font-size: 16px;
	line-height: 1.1em;
	display: inline-block;
	margin-bottom: 8px;
	text-decoration: none;
	background-color: whitesmoke;
	padding: 0 5px 5px 5px;
}
input {
	border-width: 0px;
	border-radius: 2px;
}
button {
	border-width: 0px;
	border-radius: 2px;
}
</style>



<?php

  echo '<main role="main" class="container">
        <div class="container">
        <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 order-1 order-md-0">
        '; 
        ?>
        <form name="search" method="post" action="cart.php">
		    <input type="search" name="query" placeholder="Пошук за координатами">
		    <button type="submit" name="search">Старт</button> 
		</form> 
		<?php 
		require_once 'functions.php';
		if ($_POST['search_town']) {
		    $search_result_town = search_town($_POST['search_town']); 
		    echo $search_result_town;
		    }
		if ($_POST['search_reg']) {
		    $search_result_reg = search_reg($_POST['search_reg']); 
		    echo $search_result_reg;
		    }

		if (!empty($_POST['query'])) { 
		    $search_result = search_y ($_POST['query']); 
		    echo $search_result; 
		}
		?>
		<?php
  echo '</div>';
  echo '<div class="col-12 col-sm-12 col-md-12 col-lg-8 col-xl-8 order-0 order-md-1">';
        

               
		MainColumsFull(); 
  echo '</div>';
  // echo '<div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 order-2">
  //       <div style="text-align: center;"><span style="font-weight: 600;color: #ff9800;"> - Про сторінку - </span></div>';
        
       // include 'rightpanel.php';
        
  //echo '</div>';
  echo '</div>'; 
include 'footer.php';

// Поиск



// Full rss from table




mysqli_close($link);

?>
