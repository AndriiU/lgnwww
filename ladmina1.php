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
</style>
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
<div class="form-group">
<label for="exampleFormControlInput1">Час</label>
<input class="form-control" id="exampleFormControlInput1" type="time" name="chas" required>
<label for="exampleFormControlInput1">Дата</label>
<!-- <input class="form-control" id="exampleFormControlInput1" type="text" name="data"> -->
<input class="form-control"  id="theDate" type="date" name="data" required>
	<script> 
		var date = new Date();
		var day = date.getDate();
		var month = date.getMonth() + 1;
		var year = date.getFullYear();
		if (month < 10) month = "0" + month;
		if (day < 10) day = "0" + day;
		var today = year + "-" + month + "-" + day;
		document.getElementById("theDate").value = today;
	</script>

<!-- <input  class="form-control" id="exampleFormControlInput1" type="date" name="chas" max="' . $date_today . '" min="2021-04-02" style="padding: 11px;"> -->



<label for="exampleFormControlInput1">Тип</label>
<input class="form-control" id="exampleFormControlInput1" type="text" name="tipe" required>

<script> function checkWGSKey(key) {return (key >= '0' && key <= '9') || key == '.' || key == 'ArrowLeft' || key == 'ArrowRight' || key == 'Delete' || key == 'Backspace' || key == 'Control' || key == 'v';} </script>
<label for="exampleFormControlInput1">WGS 84 (Y Google)</label>
<input class="form-control" id="exampleFormControlInput1" onkeydown="return checkWGSKey(event.key)" type="text" name="ywgs" required>

<label for="exampleFormControlInput1">WGS 84 (X Google)</label>
<input class="form-control" id="exampleFormControlInput1" onkeydown="return checkWGSKey(event.key)" type="text" name="xwgs" required>

<!-- https://www.google.com/maps/place/46.86537,32.499832 -->


<link rel="stylesheet" href="../chosen/chosen.min.css">
<label for="exampleFormControlInput1">Область</label>
<select  class="js-chosen" class="form-control" id="exampleFormControlInput1" name="region"> 
        <option value="" selected="selected">Оберіть область</option>
        <?php 
			$oblselect = mysqli_query($link,'SELECT COUNT(1) FROM `region`' );	
			$obl = mysqli_fetch_array( $oblselect );
			$obl_count = $obl[0];

			$region = mysqli_query($link,'SELECT * FROM `region`');
			for ($i=0; $i < $obl_count; $i++) { 
					$row_region = mysqli_fetch_assoc($region); 
					$region_id = $row_region['id'];
					$region_name = $row_region['region'];
					echo '<option value="'. $region_id .'"> '. $region_name .'</option>';
			}
        ?>
    </select>
<label for="exampleFormControlInput1">Населений пункт</label>
<select  class="js-chosen" class="form-control" id="exampleFormControlInput1" name="town"> 
        <option value="" selected="selected"></option>
        <?php 
			$townsselect = mysqli_query($link,'SELECT COUNT(1) FROM `towns`' );	
			$towns_i = mysqli_fetch_array( $townsselect );
			$towns_count = $towns_i[0];

			$towns = mysqli_query($link,'SELECT * FROM `towns`');
			for ($i=0; $i < $towns_count; $i++) { 
					$row_towns = mysqli_fetch_assoc($towns); 
					$id_towns = $row_towns['id_town'];
					$towns_name = $row_towns['town'];
					echo '<option value="'. $id_towns .'"> '. $towns_name .'</option>';
			}
        ?>
    </select>

<!-- <input class="form-control" id="exampleFormControlInput1" type="text" name="town" required> -->
<label for="exampleFormControlInput1">Координатор</label>
<input class="form-control" id="exampleFormControlInput1" type="text" name="name_inf" required>
<label for="exampleFormControlInput1">Телефон</label>
<script> function checkPhoneKey(key) {return (key >= '0' && key <= '9') || key == 'ArrowLeft' || key == 'ArrowRight' || key == 'Delete' || key == 'Backspace'; } </script>
<input class="form-control" id="exampleFormControlInput1" onkeydown="return checkPhoneKey(event.key)" type="tel" name="tel_inf" placeholder="Введите телефон" value="380" required>
<label for="exampleFormControlInput1">Текст повідомлення</label>
<input class="form-control" id="exampleFormControlInput1" type="text" name="desc" required>
<label for="exampleFormControlInput1">Статус</label>
<select  class="form-control" id="exampleFormControlInput1" name="status"> 
    <option value="" selected="selected">Оберіть статус</option>
    <option VALUE="dorozvidka"> Дорозвідка</option>
    <option VALUE="pidtverdjena"> Підтверджена</option>   
    <option VALUE="informator"> Інформатори</option> 
    <option VALUE="kosmos"> Космос</option>
</select>
<input type=file name=uploadfile style="margin-top: 20px;display: block;    
    padding: 0.375rem 0.75rem;font-size: 1rem;line-height: 1.5;color: #495057;
    background-color: #fff;background-clip: padding-box;border: 1px solid #ced4da;
    border-radius: 0.25rem;transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;">
<br>
<input type="submit" class="btn btn-primary" name="add-site">
</div></form>

<?php
$keysa = mysqli_query($link,'SELECT * FROM chip ORDER BY keysa DESC LIMIT 1' );	
$full = mysqli_fetch_array( $keysa );
$row_full = $full[0];
if ($row_full == NULL) {
	$row_full = 1;
} else {
	$row_full++;
}

//echo $row_full;

if (isset($_POST['add-site'])){

		// db connect
		$host = 'kt371968.mysql.tools';
		$database = 'kt371968_leg';
		$user = 'kt371968_leg';
		$password = '4@cgM7h)F5';
		$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
		if (!mysqli_set_charset($link, "utf8")) {
		    exit();
		} else {

		}

		// Каталог, в который мы будем принимать файл:
		$uploaddir = './uploads/';
		$uploadfile = $uploaddir.basename($_FILES['uploadfile']['name']);	

		$chas = $_POST['chas'];
		$data = $_POST['data'];
		$tipe = $_POST['tipe'];
		$status = $_POST['status'];
		$ywgs_n = $_POST['ywgs'];  // обрезать до 38.02002 
		$xwgs_n = $_POST['xwgs'];

		mb_internal_encoding("UTF-8");
		$ywgs = mb_substr($ywgs_n,0,8);
		$xwgs = mb_substr($xwgs_n,0,8);
		
		$town = $_POST['town'];	
		$region = $_POST['region'];
		$name_inf = $_POST['name_inf'];
		$tel_inf = $_POST['tel_inf'];
		$description = $_POST['desc'];
		$file_name = $_FILES['uploadfile']['name'];
		if ($file_name == NULL) {
			$file_name = 'nf.jpg';
		} 
		

		mysqli_query($link,"INSERT INTO chip (keysa,chas,data,tipe,ywgs,xwgs,town,region,name_inf,tel_inf,description,file_name,status) VALUES ('$row_full','$chas','$data','$tipe','$ywgs','$xwgs','$town','$region','$name_inf','$tel_inf','$description','$file_name','$status')");

		
		echo '<img src="../uploads/'.$file_name .'" style="width:100px"><br>';
		echo 'Карта - Legioner-' . $row_full . ' ' . $chas . ' ' . $data . '<br>';

		

		
		// echo 'Дата - ' . $chas . ' ' . $data . '<br>';
		echo 'Тип - ' . $tipe . '<br>';
		echo 'Координати - ' . $ywgs . ' ' . $xwgs . '<br>';

		$town = mysqli_query($link,'SELECT `town` FROM `towns` where `id_town`= "'.$town.'"' );	
		$full = mysqli_fetch_array( $town );
		$town_name = $full[0];

		echo 'НП - ' . $town_name . '<br>';

		$rega = mysqli_query($link,'SELECT `region` FROM `region` where `id`= "'.$region.'"' );	
		$full = mysqli_fetch_array( $rega );
		$rega_name = $full[0];

		echo 'Область - ' . $rega_name . ' <br>';
		echo 'Координатор - ' . $name_inf . '<br>';
		echo 'Телефон - ' . $tel_inf . '<br>';
		if ($status =="dorozvidka") {
			$status_name = "Дорозвідка";
		} elseif  ($status =="pidtverdjena") {
			$status_name = "Підтверджена";
		} elseif  ($status =="informator") {
			$status_name = "Інформатори";
		} elseif  ($status =="kosmos") {
			$status_name = "Космос";
		}
		
		echo $status_name . '<br>';
		echo 'Допис - ' . $description . '<br>';


		

		// Копируем файл из каталога для временного хранения файлов:
		if (copy($_FILES['uploadfile']['tmp_name'], $uploadfile))
		{
		// echo "<h4>Файл успешно загружен на сервер</h4>";
		}
		// else { echo "<h3>Ошибка! Не удалось загрузить файл на сервер!</h3>"; exit; }

		// Выводим информацию о загруженном файле:
		// echo "<h4>Информация о загруженном на сервер файле: </h4>";
		// echo "<p><b>Оригинальное имя загруженного файла: ".$_FILES['uploadfile']['name']."</b></p>";
		// echo "<p><b>Mime-тип загруженного файла: ".$_FILES['uploadfile']['type']."</b></p>";
		// echo "<p><b>Размер загруженного файла в байтах: ".$_FILES['uploadfile']['size']."</b></p>";
		// echo "<p><b>Временное имя файла: ".$_FILES['uploadfile']['tmp_name']."</b></p>";

}

		 


mysqli_close($link);

include 'footer.php';
?>
