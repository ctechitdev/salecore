<?php

include("../setting/conn.php");

include('../Classes/PHPExcel.php');


$date_request_from = $_POST['date_request_from'];
$request_date_from = str_replace('/', '-', $date_request_from);
$date_view_from = date('Y-m-d', strtotime($request_date_from));

$date_request_to = $_POST['date_request_to'];
$request_date_to = str_replace('/', '-', $date_request_to);
$date_view_to = date('Y-m-d', strtotime($request_date_to));


$objPHPExcel  =  new  PHPExcel();


$objPHPExcel->setActiveSheetIndex(0);


$styleArray = array(
    'font'  => array(
         
        'name'  => 'phetsarath OT'
    ));


 

$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'ENTRY TIME');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'SALES PERSON');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'CHECK ENTRY');
$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'CUSTOMER NAME');
$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'ENTRY DATE'); 

$objPHPExcel->getDefaultStyle()->applyFromArray($styleArray);


  
$rowCount = 2;

 
$stmt1 = $conn->prepare(" call rptexportpjp('$date_view_from','$date_view_to'); ");
$stmt1->execute();
if ($stmt1->rowCount() > 0) {
    while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {



        $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, mb_strtoupper($row1['time_check_in'], 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, mb_strtoupper($row1['staff_name'], 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, mb_strtoupper($row1['types'], 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, mb_strtoupper($row1['c_shop_name'], 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, mb_strtoupper($row1['date_check'], 'UTF-8')); 
        $rowCount++; 
    }
}

 

$objPHPExcel->getActiveSheet()->setTitle('PJP Data');

  

$objWriter  =  new PHPExcel_Writer_Excel2007($objPHPExcel);


header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="pjpdata.xlsx"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
?>