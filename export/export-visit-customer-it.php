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


 

$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'NO');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'VISITDATE');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'SHOPCODE');
$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'TIMEPERIOD');
$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'SALESPERSONCODE');
$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'LONGT');
$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'LATIT'); 

$objPHPExcel->getDefaultStyle()->applyFromArray($styleArray);


$i = 1;  
$rowCount = 2;



$stmt1 = $conn->prepare(" SELECT  DATE_FORMAT(date_check, '%d/%m/%Y') AS date_check ,cus_code,   
TIMESTAMPDIFF(SECOND, time_check_in, time_check_out) AS time_count,
lat_in,lon_in, staff_code
FROM tbl_visited_customer a
left join tbl_staff_sale b on a.check_by = b.user_ids 
where  date_check  between '$date_view_from' and '$date_view_to'  ");
$stmt1->execute();
if ($stmt1->rowCount() > 0) {
    while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {



        $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, mb_strtoupper($i, 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, mb_strtoupper($row1['date_check'], 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, mb_strtoupper($row1['cus_code'], 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, mb_strtoupper($row1['time_count'], 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, mb_strtoupper($row1['staff_code'], 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, mb_strtoupper($row1['lat_in'], 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, mb_strtoupper($row1['lon_in'], 'UTF-8'));  
        $rowCount++;
        $i++;
    }
}

 

$objPHPExcel->getActiveSheet()->setTitle('Item Data');

  

$objWriter  =  new PHPExcel_Writer_Excel2007($objPHPExcel);


header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="visit-customer-data-it.xlsx"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
?>