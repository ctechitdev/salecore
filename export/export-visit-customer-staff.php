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
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'ລະຫັດຮ້ານ');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'ຊື່ຮ້ານ');
$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'ຊື່ພະນັກງານ');
$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'ວັນທີ່ຢ້ຽມຢາມ');
$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'ເວລາເຂົ້າ');
$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'ເວລາອອກ'); 

$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'ຄ່າlatຕອນເຂົ້າ');
$objPHPExcel->getActiveSheet()->SetCellValue('I1', 'ຄ່າlonຕອນເຂົ້າ');
$objPHPExcel->getActiveSheet()->SetCellValue('J1', 'ຄ່າlatຕອນອອກ');
$objPHPExcel->getActiveSheet()->SetCellValue('K1', 'ຄ່າlonຕອນອອກ'); 

$objPHPExcel->getDefaultStyle()->applyFromArray($styleArray);


  
$rowCount = 2;



$stmt1 = $conn->prepare(" SELECT b.cus_code,c_shop_name,village_name,distict_name,time_check_in,
time_check_out,concat(staff_cp,' ',staff_name) as staff_name,date_check,lat_in,lon_in,lat_out,lon_out
FROM tbl_visited_customer a
left join tbl_visit_dairy b on a.cus_code = b.vd_id
left join tbl_districts c on b.district = c.dis_id
left join tbl_staff_sale d on a.check_by = d.user_ids
left join tbl_user_staff e on a.check_by = e.usid
where  date_check  between '$date_view_from' and '$date_view_to' ");
$stmt1->execute();
if ($stmt1->rowCount() > 0) {
    while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {



        $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, mb_strtoupper($rowCount, 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, mb_strtoupper($row1['cus_code'], 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, mb_strtoupper($row1['c_shop_name'], 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, mb_strtoupper($row1['staff_name'], 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, mb_strtoupper($row1['date_check'], 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, mb_strtoupper($row1['time_check_in'], 'UTF-8'));
        $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, mb_strtoupper($row1['time_check_out'], 'UTF-8'));  
        $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, mb_strtoupper($row1['lat_in'], 'UTF-8')); 
        $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, mb_strtoupper($row1['lon_in'], 'UTF-8')); 
        $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, mb_strtoupper($row1['lat_out'], 'UTF-8')); 
        $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, mb_strtoupper($row1['lon_out'], 'UTF-8')); 
        $rowCount++;
    }
}

 

$objPHPExcel->getActiveSheet()->setTitle('Item Data');

  

$objWriter  =  new PHPExcel_Writer_Excel2007($objPHPExcel);


header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="visit-customer.xlsx"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
?>