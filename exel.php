<?php
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


require_once $_SERVER['DOCUMENT_ROOT']."/PHPExcel/Classes/PHPExcel.php";
$loadfile = 'test.xlsx';//$_POST['file_name']; // получаем имя загруженного файла
//require_once $_SERVER['DOCUMENT_ROOT']."/PHPExcel/Classes/PHPExcel/IOFactory.php"; 
//$objPHPExcel = PHPExcel_IOFactory::load($_SERVER['DOCUMENT_ROOT'].$loadfile);

$objPHPExcel = PHPExcel_IOFactory::load("test.xlsx");

//var_dump($objPHPExcel);

foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) 
{
  $highestRow = $worksheet->getHighestRow(); //  количество строк
  $highestColumn = $worksheet->getHighestColumn(); // количество колонок

  echo 'aada' . $highestRow;

  for ($row = 1; $row <= $highestRow; ++ $row) // обходим все строки
  {
    $cell1 = $worksheet->getCellByColumnAndRow(0, $row); //Дата
    $cell2 = $worksheet->getCellByColumnAndRow(1, $row); //время
    $cell3 = $worksheet->getCellByColumnAndRow(2, $row); //координаты
    $cell4 = $worksheet->getCellByColumnAndRow(3, $row); //Напр. начало
    $cell5 = $worksheet->getCellByColumnAndRow(4, $row); //Напр. конец
    $cell6 = $worksheet->getCellByColumnAndRow(5, $row); //Тер принадлежность
    $cell7 = $worksheet->getCellByColumnAndRow(6, $row); //Движение
    $cell8 = $worksheet->getCellByColumnAndRow(7, $row); //Тип
    $cell9 = $worksheet->getCellByColumnAndRow(8, $row); //Контакт
    $cell10 = $worksheet->getCellByColumnAndRow(9, $row); //Примечание
    $cell11 = $worksheet->getCellByColumnAndRow(10, $row); //Танк
    $cell12 = $worksheet->getCellByColumnAndRow(11, $row); //Броня
    $cell13 = $worksheet->getCellByColumnAndRow(12, $row); //Груз
    $cell14 = $worksheet->getCellByColumnAndRow(13, $row); //РСЗВ
    $cell15 = $worksheet->getCellByColumnAndRow(14, $row); //ППО
    $cell16 = $worksheet->getCellByColumnAndRow(15, $row); //Цистерна
    $cell17 = $worksheet->getCellByColumnAndRow(16, $row); //связь
    $cell18 = $worksheet->getCellByColumnAndRow(17, $row); //Арта
    $cell19 = $worksheet->getCellByColumnAndRow(18, $row); //ОТРК



    $sql = "INSERT INTO `orki` (`data`,`time`,`cord`,`start`,`end`,`region`,`fact`,`type`,`cont`,`desc`,`tank`,`btr`,`vant`,`rszv`,`pvo`,`ink`,`svyaz`,`arta`,`otrk`) VALUES
('$cell1','$cell2','$cell3','$cell4','$cell5','$cell6','$cell7','$cell8','$cell9','$cell10','$cell11','$cell12','$cell13','$cell14','$cell15','$cell16','$cell17','$cell18')";
    $query = mysql_query($sql) or die('Ошибка чтения записи: '.mysql_error());
    echo $cell1. "<br>";
  }
}

?>