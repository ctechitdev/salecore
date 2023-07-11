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


 

$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'ລຳດັບ');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'ປະເພດ');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'ເປົ້າເດືອນ');
$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'ຢ້ຽມຢາມ');
$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'ເປັນເປີເຊັນ');
$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'ເປົ້າຍອດຊື້');
$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'ການຊື້');
$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'ເປັນເປີເຊັນ');
$objPHPExcel->getActiveSheet()->SetCellValue('I1', 'ເປົ້າລິດ');
$objPHPExcel->getActiveSheet()->SetCellValue('J1', 'ຍອດຊື້(ລິດ)');
$objPHPExcel->getActiveSheet()->SetCellValue('K1', 'ເປັນເປີເຊັນ');
$objPHPExcel->getActiveSheet()->SetCellValue('L1', 'ເປົ້າລູກຄ້າໃໝ່');
$objPHPExcel->getActiveSheet()->SetCellValue('M1', 'ລູກຄ້າໃໝ່');
$objPHPExcel->getActiveSheet()->SetCellValue('N1', 'ເປັນເປີເຊັນ');

$objPHPExcel->getDefaultStyle()->applyFromArray($styleArray);


  
$rowCount = 2;



$stmt1 = $conn->prepare("call rpt_sumary_visit_sale_report('$date_view_from','$date_view_to')  ");
$stmt1->execute();
if ($stmt1->rowCount() > 0) {
    while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {



        $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, mb_strtoupper($rowCount, 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, mb_strtoupper($row1['customer_type'], 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, mb_strtoupper("", 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, mb_strtoupper($row1['count_visit'], 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, mb_strtoupper("", 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, mb_strtoupper("", 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, mb_strtoupper($row1['count_buy'], 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, mb_strtoupper("", 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, mb_strtoupper("", 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, mb_strtoupper("", 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, mb_strtoupper("", 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, mb_strtoupper("", 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, mb_strtoupper($row1['new_count'], 'UTF-8')); 
        $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, mb_strtoupper("", 'UTF-8'));
        $rowCount++;
    }
}

 

$objPHPExcel->getActiveSheet()->setTitle('Item Data');

  

$objWriter  =  new PHPExcel_Writer_Excel2007($objPHPExcel);


header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="report_sumary_visit_sale.xlsx"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
