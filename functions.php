<?php
function search_y ($query) 
{ 
	$host = 'kt371968.mysql.tools';
	$database = 'kt371968_leg';
	$user = 'kt371968_leg';
	$password = '4@cgM7h)F5';
	$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
	if (!mysqli_set_charset($link, "utf8")) {
	    exit();
	} else {
	  
	}
		$string = $query;
		$separator = " \t\n";
		$array_words = [];
		$tok = strtok($string, $separator);

		while($tok) {
		    $array_words[] = $tok;
		    $tok = strtok($separator);
		}
		$y = $array_words[0];
		$x = $array_words[1];

  		$result = mysqli_query($link,"SELECT `keysa`,`ywgs`,`xwgs`,`chas`,`tipe`,`data`,`town`,`region`,`name_inf`,`tel_inf`,`file_name`,`description` FROM `chip` WHERE `ywgs` LIKE '%$y%' AND `xwgs` LIKE '%$x%' ");
         
            $row = mysqli_fetch_assoc($result); 
            $num = mysqli_num_rows($result);
            $text = '<p>По запросу <b>'.$query.'</b> найдено совпадений: '.$num.'</p>';

            do {               
                $keysa = $row['keysa'];
                $chas = $row['chas'];
				$tipe = $row['tipe'];
				$data = $row['data'];
				$data = date("d.m.Y", strtotime($data));
				$ywgs = $row['ywgs'];
				$xwgs = $row['xwgs'];
				$town = $row['town'];	
				$region = $row['region'];
				$name_inf = $row['name_inf'];
				$tel_inf = $row['tel_inf'];
				$description = $row['description'];
				$file_name = $row['file_name'];
				if ($file_name == NULL) {
					$file_name = "nf.jpg";
				}
                if (mysqli_affected_rows() > 0) {
                    $row1 = mysqli_fetch_assoc($row_main);
                }                
                echo $chas;
                $text .= '<div style="color: #333;font-size: 16px;line-height: 1.1em;display: inline-block;margin-bottom: 8px;text-decoration: none;background-color: whitesmoke;padding: 0 5px 5px 5px;" target="_blank">
                Legioner - '.$keysa.' 
                <span style="color:#a7a7a8;font-size: 12px;float:right">' .$chas . '  '.$data .' </span><br>'.$ywgs.' '.$xwgs.'<span style="color:#a7a7a8;font-size: 14px;margin-top: 3px;"></span><br>
		         
		         <div style="float:left; width:100px"><a href="../uploads/'.$file_name .'" target="_blank"><img src="../uploads/'.$file_name .'" style="width:100px"></a> </div>
		         <div style="float:right; width:60%"><span style="color:#a7a7a8;font-size: 16px;">'.$town.' '.$region.'</span></div>
		         <div style="width: 100%;float: left;">'.$name_inf.' '.$tel_inf.' '.$description.'</div>
		          </div><br>';
            } 
            while ($row = mysqli_fetch_assoc($result)); 
    return $text; 
} 

function search_town ($query_town) 
{ 
	$host = 'kt371968.mysql.tools';
	$database = 'kt371968_leg';
	$user = 'kt371968_leg';
	$password = '4@cgM7h)F5';
	$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
	if (!mysqli_set_charset($link, "utf8")) {
	    exit();
	} else {
	  
	}
  		//echo $query_town. '44444';
  		$result = mysqli_query($link,"SELECT `keysa`,`ywgs`,`xwgs`,`chas`,`tipe`,`data`,`town`,`region`,`name_inf`,`tel_inf`,`file_name`,`description` FROM `chip` WHERE `town` = '".$query_town."'");
        
            $row = mysqli_fetch_assoc($result); 
            $num = mysqli_num_rows($result);
            $text = '<p>По запросу <b>'.$query_town.'</b> найдено совпадений: '.$num.'</p>';
            //var_dump($row);

            do {               
                $keysa = $row['keysa'];
                $chas = $row['chas'];
				$tipe = $row['tipe'];
				$data = $row['data'];
				$data = date("d.m.Y", strtotime($data));
				$ywgs = $row['ywgs'];
				$xwgs = $row['xwgs'];
				$town = $row['town'];
				$town_i = mysqli_query($link,'SELECT `town` FROM `towns` where `id_town`= "'.$town.'"' );	
				$full = mysqli_fetch_array( $town_i );
				$town_name = $full[0];	
				$region = $row['region'];
				$rega = mysqli_query($link,'SELECT `region` FROM `region` where `id`= "'.$region_id.'"' );	
				$full = mysqli_fetch_array( $rega );
				$region_name = $full[0];

				$name_inf = $row['name_inf'];
				$tel_inf = $row['tel_inf'];
				$description = $row['description'];
				$file_name = $row['file_name'];
				if ($file_name == NULL) {
					$file_name = "nf.jpg";
				}
                if (mysqli_affected_rows() > 0) {
                    $row1 = mysqli_fetch_assoc($row_main);
                }                
                
                $text .= '<div style="color: #333;font-size: 16px;line-height: 1.1em;display: inline-block;margin-bottom: 8px;text-decoration: none;background-color: whitesmoke;padding: 0 5px 5px 5px;" target="_blank">'.$query_town.'
                	Legioner - '.$keysa.' 
                	<span style="color:#a7a7a8;font-size: 12px;float:right">' .$chas . '  '.$data .' </span><br>'.$ywgs.' '.$xwgs.'<span style="color:#a7a7a8;font-size: 14px;margin-top: 3px;"></span><br>	         
		         	<div style="float:left; width:100px"><a href="../uploads/'.$file_name .'" target="_blank"><img src="../uploads/'.$file_name .'" style="width:100px"></a> </div>
		         	<div style="float:right; width:60%"><span style="color:#a7a7a8;font-size: 16px;">'.$town_name.' '.$region_name.'</span></div>
		         	<div style="width: 100%;float: left;">'.$name_inf.' '.$tel_inf.' '.$description.'</div>
		          	</div><br>';

            } 
            while ($row = mysqli_fetch_assoc($result)); 
    return $text; 
} 

// поиск по области
function search_reg ($query_reg) 
{ 
	$host = 'kt371968.mysql.tools';
	$database = 'kt371968_leg';
	$user = 'kt371968_leg';
	$password = '4@cgM7h)F5';
	$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
	if (!mysqli_set_charset($link, "utf8")) {
	    exit();
	} else {
	  
	}
  		//echo $query_reg;

  		$result = mysqli_query($link,'SELECT `keysa`,`ywgs`,`xwgs`,`chas`,`tipe`,`data`,`town`,`region`,`name_inf`,`tel_inf`,`file_name`,`description` FROM `chip` where `region`= "'.$query_reg.'"' );
        
            $row = mysqli_fetch_assoc($result); 
            $num = mysqli_num_rows($result);
            $text = '<p>По запросу <b>'.$query_reg.'</b> найдено совпадений: '.$num.'</p>';
            //var_dump($row);

            do {               
                $keysa = $row['keysa'];
                $chas = $row['chas'];
				$tipe = $row['tipe'];
				$data = $row['data'];
				$data = date("d.m.Y", strtotime($data));
				$ywgs = $row['ywgs'];
				$xwgs = $row['xwgs'];
				$town = $row['town'];	
				$town = mysqli_query($link,'SELECT `town` FROM `towns` where `id_town`= "'.$town.'"' );	
				$full = mysqli_fetch_array( $town );
				$town_name = $full[0];
				$region = $row['region'];
				$rega = mysqli_query($link,'SELECT `region` FROM `region` where `id`= "'.$region_id.'"' );	
				$full = mysqli_fetch_array( $rega );
				$region_name = $full[0];

				$name_inf = $row['name_inf'];
				$tel_inf = $row['tel_inf'];
				$description = $row['description'];
				$file_name = $row['file_name'];
				if ($file_name == NULL) {
					$file_name = "nf.jpg";
				}
                if (mysqli_affected_rows() > 0) {
                    $row1 = mysqli_fetch_assoc($row);
                }                
                
                $text .= '<div style="color: #333;font-size: 16px;line-height: 1.1em;display: inline-block;margin-bottom: 8px;text-decoration: none;background-color: whitesmoke;padding: 0 5px 5px 5px;" target="_blank">
                	Legioner - '.$keysa.' 
                	<span style="color:#a7a7a8;font-size: 12px;float:right">' .$chas . '  '.$data .' </span><br>'.$ywgs.' '.$xwgs.'<span style="color:#a7a7a8;font-size: 14px;margin-top: 3px;"></span><br>	         
		         	<div style="float:left; width:100px"><a href="../uploads/'.$file_name .'" target="_blank"><img src="../uploads/'.$file_name .'" style="width:100px"></a></div>
		         	<div style="float:right; width:60%"><span style="color:#a7a7a8;font-size: 16px;">'.$town_name.' '.$region_name.'</span></div>
		         	<div style="width: 100%;float: left;">'.$name_inf.' '.$tel_inf.' '.$description.'</div>
		          	</div><br>';

            } 
            while ($row = mysqli_fetch_assoc($result)); 
    return $text; 
}

function MainColumsFull(){
	$host = 'kt371968.mysql.tools';
	$database = 'kt371968_leg';
	$user = 'kt371968_leg';
	$password = '4@cgM7h)F5';
	$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
	if (!mysqli_set_charset($link, "utf8")) {
	    exit();
	} else {

	}
	$today = date("H:i");
	$get_data_input = date("y.m.d"); 

	$connect_to_today = mysqli_query($link,'SELECT * FROM `chip`');
	$c_today = mysqli_query($link,'SELECT COUNT(1) FROM `chip`' );	
    $d_today = mysqli_fetch_array( $c_today );
    $row_site_today = $d_today[0];
    $c_yesterday = mysqli_query($link,'SELECT COUNT(1) FROM `chas` where (`data` != "'. $get_data_input . '")' );
    $d_yesterday = mysqli_fetch_array( $c_yesterday );
    $row_site_yesterday = $d_yesterday[0];

	echo '<div style="text-align: center;"><span style="font-weight: 600;color: #ff9800;"> - Іиформація станом на '. $get_data_input.' '. $today .' - </span></div>';
  	
	for ($i=0; $i < $row_site_today; $i++) { 
		$row_main = mysqli_fetch_assoc($connect_to_today); 
		$chas = $row_main['chas'];
		$tipe = $row_main['tipe'];
		$data = $row_main['data'];
		$ywgs = $row_main['ywgs'];
		$xwgs = $row_main['xwgs'];

		$town = $row_main['town'];	
		$town_i = mysqli_query($link,'SELECT `town` FROM `towns` where `id_town`= "'.$town.'"' );	
		$full = mysqli_fetch_array( $town_i );
		$town_name = $full[0];

		$region_id = $row_main['region'];

		$rega = mysqli_query($link,'SELECT `region` FROM `region` where `id`= "'.$region_id.'"' );	
		$full = mysqli_fetch_array( $rega );
		$region_name = $full[0];

		$name_inf = $row_main['name_inf'];
		$tel_inf = $row_main['tel_inf'];
		$description = $row_main['description'];
		$file_name = $row_main['file_name'];
		if ($file_name == NULL) {
			$file_name = "nf.jpg";
		}

        echo '<div  style="color: #333;font-size: 16px;line-height: 1.1em;display: inline-block;margin-bottom: 8px;text-decoration: none;background-color: whitesmoke;padding: 0 5px 5px 5px;" target="_blank">'; 
        echo '<span style="color:#a7a7a8;font-size: 12px;">' .$chas . ' . '.$data .' </span>';
        echo $ywgs.' '.$xwgs;
        echo '<div style="color:#a7a7a8;font-size: 14px;margin-top: 3px;width:100%"> ';
        echo '
        <form name="search_town" method="post" action="../cart.php" style="float:left">
		    <button type="submit" name="search_town" value="'.$town.'"> '.$town_name.'</button> 
		</form> ';
		echo '
        <form name="search_reg" method="post" action="../cart.php" style="">
		    <button type="submit" name="search_reg" value="'.$region_id.'"> '.$region_name.'</button> 
		</form> ';
        
        //var_dump($region);
        echo '</div>';
        echo '<a href="../uploads/'.$file_name .'" target="_blank"><img src="../uploads/'.$file_name .'" style="width:100px"></a> ';
        echo $name_inf.' '.$tel_inf;
        echo $description;
        echo '</div><br>';
	}
}