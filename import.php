<?php

//$loadfile = $_POST['file_name']; 
require_once $_SERVER['DOCUMENT_ROOT']."/PHPExcel/Classes/PHPExcel/IOFactory.php"; 
//$objPHPExcel = PHPExcel_IOFactory::load($_SERVER['DOCUMENT_ROOT']."/uploads/".$loadfile);
$objPHPExcel = PHPExcel_IOFactory::load($_SERVER['DOCUMENT_ROOT']."/uploads/PVA2804.xlsx");
foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) 
{
  $highestRow = $worksheet->getHighestRow(); 
  $highestColumn = $worksheet->getHighestColumn(); 

  for ($row = 1; $row <= $highestRow; ++ $row) 
  {
    $cell1 = $worksheet->getCellByColumnAndRow(0, $row); 
    $cell2 = $worksheet->getCellByColumnAndRow(1, $row); 
    $cell3 = $worksheet->getCellByColumnAndRow(2, $row); 
    $cell4 = $worksheet->getCellByColumnAndRow(3, $row); 
    $cell5 = $worksheet->getCellByColumnAndRow(4, $row); 
    $cell6 = $worksheet->getCellByColumnAndRow(5, $row); 
    $cell7 = $worksheet->getCellByColumnAndRow(6, $row); 
    $cell8 = $worksheet->getCellByColumnAndRow(7, $row); 
    $cell9 = $worksheet->getCellByColumnAndRow(8, $row); 
    $cell10 = $worksheet->getCellByColumnAndRow(9, $row);

    //echo $cell10 . '<br>';
    //$objPHPExcel->getActiveSheet()->getCell('B8')->getValue();
    //echo trim($cell10);
    //echo $cell10->getCoordinates();

    //$sql = "INSERT INTO `price` (`article`,`name`,`quantity`,`price`,`currency`,`unit`) VALUES ('$cell1','$cell2','$cell3','$cell4','$cell5','$cell6')";
    //$query = mysql_query($sql) or die('íÜÕÀÉÞ ÂÐÅÌÕÚ ÃÞÎÕßÕ: '.mysql_error());
  }
}
$xlsFile = $_SERVER['DOCUMENT_ROOT']."/uploads/PVA2804.xlsx";
require_once $_SERVER['DOCUMENT_ROOT']."/PHPExcel/Classes/PHPExcel/Reader/Excel2007.php";
$objReader = new PHPExcel_Reader_Excel2007();
//$objReader->setReadDataOnly(true);
$data = $objReader->load($xlsFile);
$objWorksheet = $data->getActiveSheet();
foreach ($objWorksheet->getDrawingCollection() as $drawing) {
//for XLSX format
$string = $drawing->getCoordinates();
$coordinate = PHPExcel_Cell::coordinateFromString($string);
if ($drawing instanceof PHPExcel_Worksheet_Drawing){
$filename = $drawing->getPath();
echo $filename."<br>";
$drawing->getDescription();

print_r($drawing->getDescription());

copy($filename, './uploads/' . $drawing->getDescription());

// if (copy($_FILES['uploadfile']['tmp_name'], $uploadfile))
//     {
//     echo "<h3>Файл успешно загружен на сервер</h3>";
//     }
//     else { echo "<h3>Ошибка! Не удалось загрузить файл на сервер!</h3>"; exit; }
}}