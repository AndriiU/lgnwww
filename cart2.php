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
</style>



<?php

  echo '<main role="main" class="container">
        <div class="container">
        <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 order-1 order-md-0">'; 
           //LeftSidebar(); 
       echo "Test"; 
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



// Full rss from table
function MainColumsFull(){
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
	// end connect
	$today = date("H:i");
	//echo $today;
	$get_data_input = date("y.m.d"); 


	//$connect_to_today = mysqli_query($link,'SELECT * FROM `chip` where (`chas` < "' . $today . '") AND (`data` = "'. $get_data_input . '") ORDER BY `chas` DESC' );
	$connect_to_today = mysqli_query($link,'SELECT * FROM `chip2`');
	//var_dump($connect_to_today);

	//$connect_to_today = mysqli_query($link,'SELECT * FROM `chip` where ((`chas` < "' . $today . '") AND (`data` = "'. $get_data_input . '") ORDER BY `timen` DESC' );
	//$connect_to_yesterday = mysqli_query($link,'SELECT * FROM `' . $table . '` where (`data` != "'. $get_data_input . '") ORDER BY `timen` DESC');

	$c_today = mysqli_query($link,'SELECT COUNT(1) FROM `chip2`' );	
	//$c_today = mysqli_query($link,'SELECT COUNT(1) FROM `chas` where (`data` = "'. $get_data_input . '")' );		
    $d_today = mysqli_fetch_array( $c_today );
    $row_site_today = $d_today[0];

    $c_yesterday = mysqli_query($link,'SELECT COUNT(1) FROM `chas` where (`data` != "'. $get_data_input . '")' );
    $d_yesterday = mysqli_fetch_array( $c_yesterday );
    $row_site_yesterday = $d_yesterday[0];

	echo '<div style="text-align: center;"><span style="font-weight: 600;color: #ff9800;"> - '. $today .' - </span></div>';
  	
	for ($i=0; $i < $row_site_today; $i++) { 
		$row_main = mysqli_fetch_assoc($connect_to_today); 
		$chas = $row_main['chas'];
		$tipe = $row_main['tipe'];
		$data = $row_main['data'];
		$ywgs = $row_main['ywgs'];
		$xwgs = $row_main['xwgs'];
		$town = $row_main['town'];	
		$region = $row_main['region'];
		$name_inf = $row_main['name_inf'];
		$tel_inf = $row_main['tel_inf'];
		$description = $row_main['description'];
		$file_name = $row_main['file_name'];
		if ($file_name == NULL) {
			$file_name = "nf.jpg";
		}

        //$time = date('H:i', strtotime($timen));
		echo $file_name;
       	 // if (($q % 2) == 0) {
        	// echo '<a href="../uploads/'.$file_name .'" style="color: #333;font-size: 16px;line-height: 1.1em;display: inline-block;margin-bottom: 8px;text-decoration: none;background-color: whitesmoke;padding: 0 5px 5px 5px;" target="_blank"><span style="color:#a7a7a8;font-size: 12px;">' .$chas . ' . '.$data .' </span>'.$ywgs.' '.$xwgs.' <span style="color:#a7a7a8;font-size: 14px;margin-top: 3px;"> '.$town.' '.$region.'</span><img src="../uploads/'.$file_name .'" style="width:100px"> '.$name_inf.' '.$tel_inf.' '.$description.'</a><br>';
         // } else {
        	// echo '<a href="../uploads/'.$file_name .'" style="color: #333;font-size: 16px;line-height: 1.1em;display: inline-block;margin-bottom: 8px;text-decoration: none;padding: 0 5px 5px 5px;" target="_blank"><span style="color:#a7a7a8;font-size: 12px;">' .$chas . ' . '.$data .' </span>'.$ywgs.' '.$xwgs.' <span style="color:#a7a7a8;font-size: 14px;margin-top: 3px;"> '.$town.' '.$region.'</span><img src="../uploads/'.$file_name .'" style="width:100px"> '.$name_inf.' '.$tel_inf.'</a>'.$description.'<br>';
         // }
	}
	
	
}



mysqli_close($link);

?>
