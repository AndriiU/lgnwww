<?
//include 'function.php';
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

// db connect
	$host = 'kt371968.mysql.tools';
	$database = 'kt371968_med';
	$user = 'kt371968_med';
	$password = 'mu4cU@^L65';
	$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
	if (!mysqli_set_charset($link, "utf8")) {
	    //printf("Ошибка при загрузке набора символов utf8: %s\n", mysqli_error($link));
	    exit();
	} else {
	    //printf("Текущий набор символов: %s\n", mysqli_character_set_name($link));
	}
// end connect

// Show site

// Tables

// children - Про дітей
// covid - COVID-19
// healthinfo - Новини Здоров'я
// leftdown - Інфекційне
// likari-dlya-mam - Про сімейне 
// main - Головне

?>


<?php

// insert site
		echo '<form action="' . $_SERVER["PHP_SELF"] . '" method="post">';
		echo '<div class="form-group">';
		echo '<label for="exampleFormControlInput1">Site name</label>';
		echo '<input class="form-control" id="exampleFormControlInput1" type="text" name="site_name">';
		echo '<label for="exampleFormControlInput1">Site link</label>';
		echo '<input class="form-control" id="exampleFormControlInput1" type="text" name="site_link">';
		echo '<label for="exampleFormControlInput1">Category</label>';
		echo '<select  class="form-control" id="exampleFormControlInput1" type="text" name="category">
					<option selected="selected">Выберите раздел</option>
					<option value="children">Про дітей</option>
					<option value="covid">COVID-19</option>
					<option value="healthinfo">Новини Здоров&#039;я</option>
					<option value="leftdown">Інфекційне</option>
					<option value="likari-dlya-mam">Про сімейне</option>
					<option value="main">Головне</option>
				</select>';
		echo '<label for="exampleFormControlInput1">Link feed</label>';
		echo '<input class="form-control" id="exampleFormControlInput1" type="text" name="link_feed">';
		echo '<label for="exampleFormControlInput1">File name</label>';
		echo '<input class="form-control" id="exampleFormControlInput1" type="text" name="file_name">';
		echo '<label for="exampleFormControlInput1">Page name</label>';
		echo '<input class="form-control" id="exampleFormControlInput1" type="text" name="site_page">'; 
		echo '<label for="exampleFormControlInput1">Title</label>';
		echo '<input class="form-control" id="exampleFormControlInput1" type="text" name="page_title">'; 
		echo '<label for="exampleFormControlInput1">Description</label>';
		echo '<input class="form-control" id="exampleFormControlInput1" type="text" name="page_desc">';
		
		echo '<br>';
		echo '<input type="submit" class="btn btn-primary" name="add-site">';
		echo '</div></form>';

		if (isset($_POST['add-site'])){

				$site_name = $_POST['site_name'];
				$site_link = $_POST['site_link'];
				$category = $_POST['category'];
				$link_feed = $_POST['link_feed'];	
				$file_name = $_POST['file_name'];
				$site_page = $_POST['site_page'];
				$page_title = $_POST['page_title'];
				$page_desc = $_POST['page_desc'];

				mysqli_query($link,"INSERT INTO site (site_name,category,link_feed,site_link,site_page,page_title,page_desc) VALUES ('$site_name','$category','$link_feed','$site_link','$site_page','$page_title','$page_desc')");

				echo 'Добавлено сайт - ' . $site_name . '<br>';
				echo 'В категорию - ' . $category . '<br>';
				echo 'Фид - ' . $link_feed . '<br>';
				echo 'Адрес сайта - ' . $site_link . '<br>';
				echo 'Создан файл - ' . $file_name . '.php <br>';
				echo 'URL страницы - ' . $site_page . '<br>';
				echo 'Заголовок - ' . $page_title . '<br>';
				echo 'Описание- ' . $page_desc . '<br>';
				echo 'CRONTAB' . '<br>';
				echo '/usr/local/php74/bin/php -c /home/kt371968/.system/php/www.emed.space.ini /home/kt371968/emed.space/www/' . $file_name . '.php';

		}

// create file

//$work_dir = $HTTP_SERVER_VARS['DOCUMENT_ROOT'];


		 //chdir($country_select);
		 $file = $file_name.'.php';
		 if( !file_exists($file)) {
		 $fp = fopen($file, "w");

		 fwrite($fp,'<?php
include "simple_html_dom.php";
include "base.php";
include "functions.php";
$rss_in = "' . $link_feed . '";
$category = "' . $category . '";
$site_title = "' . $site_name . '";
deleteFeedHistory($link,$category,$site_title);
$rss = simplexml_load_file($rss_in);
insertMainBase($rss, $site_title, $date_today, $link, $category);
?>');


		 fclose ($fp);
		 }


mysqli_close($link);

include 'footer.php';
?>
