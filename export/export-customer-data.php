<?php

include("../setting/conn.php");

include('../Classes/PHPExcel.php');

$objPHPExcel  =  new  PHPExcel();
 

$objPHPExcel->setActiveSheetIndex(0);
 




$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'CardCode');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'U_ZONE');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'U_Class');
$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'U_Channel');
$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'U_Group_Channel');
$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'U_Shop_Type');
$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'CardName');
$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'CardForeignName');
$objPHPExcel->getActiveSheet()->SetCellValue('I1', 'CardType');
$objPHPExcel->getActiveSheet()->SetCellValue('J1', 'GroupCode');
$objPHPExcel->getActiveSheet()->SetCellValue('K1', 'PriceListNum');
$objPHPExcel->getActiveSheet()->SetCellValue('L1', 'DebitorAccount');
$objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Currency');
$objPHPExcel->getActiveSheet()->SetCellValue('N1', 'VatGroup');
$objPHPExcel->getActiveSheet()->SetCellValue('O1', 'BilltoDefault');
$objPHPExcel->getActiveSheet()->SetCellValue('P1', 'ShipToDefault');
$objPHPExcel->getActiveSheet()->SetCellValue('Q1', 'CreditLimit');
$objPHPExcel->getActiveSheet()->SetCellValue('R1', 'PayTermsGrpCode');
$objPHPExcel->getActiveSheet()->SetCellValue('S1', 'ContactPerson');
$objPHPExcel->getActiveSheet()->SetCellValue('T1', 'Phone1');
$objPHPExcel->getActiveSheet()->SetCellValue('U1', 'Phone2');
$objPHPExcel->getActiveSheet()->SetCellValue('V1', 'Fax');
$objPHPExcel->getActiveSheet()->SetCellValue('W1', 'Street');
$objPHPExcel->getActiveSheet()->SetCellValue('X1', 'Block');
$objPHPExcel->getActiveSheet()->SetCellValue('Y1', 'City');
$objPHPExcel->getActiveSheet()->SetCellValue('Z1', 'County');
$objPHPExcel->getActiveSheet()->SetCellValue('AA1', 'Country');
$objPHPExcel->getActiveSheet()->SetCellValue('AB1', 'Valid');
$objPHPExcel->getActiveSheet()->SetCellValue('AC1', 'ValidFrom');
$objPHPExcel->getActiveSheet()->SetCellValue('AD1', 'AddId');
$objPHPExcel->getActiveSheet()->SetCellValue('AE1', 'SalesPersonCode');
$objPHPExcel->getActiveSheet()->SetCellValue('AF1', 'U_OwnerEName');
$objPHPExcel->getActiveSheet()->SetCellValue('AG1', 'U_OwnerName');
$objPHPExcel->getActiveSheet()->SetCellValue('AH1', 'U_Gender');

$objPHPExcel->getActiveSheet()->SetCellValue('A2', 'CardCode');
$objPHPExcel->getActiveSheet()->SetCellValue('B2', 'U_ZONE');
$objPHPExcel->getActiveSheet()->SetCellValue('C2', 'U_Class');
$objPHPExcel->getActiveSheet()->SetCellValue('D2', 'U_Channel');
$objPHPExcel->getActiveSheet()->SetCellValue('E2', 'U_Group_Channel');
$objPHPExcel->getActiveSheet()->SetCellValue('F2', 'U_Shop_Type');
$objPHPExcel->getActiveSheet()->SetCellValue('G2', 'CardName');
$objPHPExcel->getActiveSheet()->SetCellValue('H2', 'CardFName');
$objPHPExcel->getActiveSheet()->SetCellValue('I2', 'CardType');
$objPHPExcel->getActiveSheet()->SetCellValue('J2', 'GroupCode');
$objPHPExcel->getActiveSheet()->SetCellValue('K2', 'ListNum');
$objPHPExcel->getActiveSheet()->SetCellValue('L2', 'DebitorAccount');
$objPHPExcel->getActiveSheet()->SetCellValue('M2', 'Currency');
$objPHPExcel->getActiveSheet()->SetCellValue('N2', 'ECVatGroup');
$objPHPExcel->getActiveSheet()->SetCellValue('O2', 'BillToDef');
$objPHPExcel->getActiveSheet()->SetCellValue('P2', 'ShipToDef');
$objPHPExcel->getActiveSheet()->SetCellValue('Q2', 'CreditLine');
$objPHPExcel->getActiveSheet()->SetCellValue('R2', 'GroupNum');
$objPHPExcel->getActiveSheet()->SetCellValue('S2', 'CntctPrsn');
$objPHPExcel->getActiveSheet()->SetCellValue('T2', 'Phone1');
$objPHPExcel->getActiveSheet()->SetCellValue('U2', 'Phone2');
$objPHPExcel->getActiveSheet()->SetCellValue('V2', 'Fax');
$objPHPExcel->getActiveSheet()->SetCellValue('W2', 'Address');
$objPHPExcel->getActiveSheet()->SetCellValue('X2', 'Block');
$objPHPExcel->getActiveSheet()->SetCellValue('Y2', 'City');
$objPHPExcel->getActiveSheet()->SetCellValue('Z2', 'County');
$objPHPExcel->getActiveSheet()->SetCellValue('AA2', 'Country');
$objPHPExcel->getActiveSheet()->SetCellValue('AB2', 'ValidFor');
$objPHPExcel->getActiveSheet()->SetCellValue('AC2', 'ValidFrom');
$objPHPExcel->getActiveSheet()->SetCellValue('AD2', 'AddId');
$objPHPExcel->getActiveSheet()->SetCellValue('AE2', 'SlpCode');
$objPHPExcel->getActiveSheet()->SetCellValue('AF2', 'U_OwnerEName');
$objPHPExcel->getActiveSheet()->SetCellValue('AG2', 'U_OwnerName');
$objPHPExcel->getActiveSheet()->SetCellValue('AH2', 'U_Gender');


$rowCount = 3;

for ($x = 0; $x < count($_POST['check_box']); $x++) {
  $check_box = $_POST['check_box'][$x];



  $stmt1 = $conn->prepare(" select c_zone,c_class,c_code,c_shop_name,gender,c_name,c_eng_name,pv_name,distict_name,village,street,h_unit,h_number,pl_id,
  identfy_number,location_des,phone1,phone2,fax,payment_type,credit_values,(case when payment_term = 0 then '' else payment_term end) as payment_term,
  contact_by,contact_phone,staff_contact,shop_type,
  service_type,visit_days,  DATE_FORMAT(date_register, '%Y%m%d') AS date_register ,add_by,b.acc_code as debitoraccount, concat('S',a.acc_code) as vatgroup,
  identfy_number,(case when staff_contact = 0 then '' else staff_contact end) as staff_contact
  from tbl_customer a
  left join tbl_account_company b on a.acc_code = b.company_code 
  left join tbl_provinces c on a.provinces = c.pv_id
  left join tbl_districts d on a.district = d.dis_id
  where c_id = '$check_box'  ");
  $stmt1->execute();
  if ($stmt1->rowCount() > 0) {
    while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {




      $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, mb_strtoupper($row1['c_code'], 'UTF-8'));
      $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, mb_strtoupper($row1['c_zone'], 'UTF-8'));
      $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, mb_strtoupper($row1['c_class'], 'UTF-8'));
      $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, mb_strtoupper($row1['visit_days'], 'UTF-8'));
      $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, mb_strtoupper('', 'UTF-8'));
      $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, mb_strtoupper($row1['shop_type'], 'UTF-8'));
      $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, mb_strtoupper($row1['c_shop_name'], 'UTF-8'));
      $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, mb_strtoupper($row1['c_name'], 'UTF-8'));
      $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, mb_strtoupper('C', 'UTF-8'));
      $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, mb_strtoupper('2', 'UTF-8'));
      $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, mb_strtoupper($row1['pl_id'], 'UTF-8'));
      $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, mb_strtoupper($row1['debitoraccount'], 'UTF-8'));
      $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, mb_strtoupper('##', 'UTF-8'));
      $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, mb_strtoupper($row1['vatgroup'], 'UTF-8'));
      $objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, 'Bill To');
      $objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, 'Ship To');
      $objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowCount, mb_strtoupper($row1['credit_values'], 'UTF-8'));
      $objPHPExcel->getActiveSheet()->SetCellValue('R' . $rowCount, mb_strtoupper($row1['payment_term'], 'UTF-8'));
      $objPHPExcel->getActiveSheet()->SetCellValue('S' . $rowCount, mb_strtoupper($row1['contact_by'], 'UTF-8'));
      $objPHPExcel->getActiveSheet()->SetCellValue('T' . $rowCount, mb_strtoupper($row1['phone1'], 'UTF-8'));
      $objPHPExcel->getActiveSheet()->SetCellValue('U' . $rowCount, mb_strtoupper($row1['phone2'], 'UTF-8'));
      $objPHPExcel->getActiveSheet()->SetCellValue('V' . $rowCount, mb_strtoupper($row1['fax'], 'UTF-8'));
      $objPHPExcel->getActiveSheet()->SetCellValue('W' . $rowCount, mb_strtoupper($row1['street'], 'UTF-8'));
      $objPHPExcel->getActiveSheet()->SetCellValue('X' . $rowCount, mb_strtoupper($row1['village'], 'UTF-8'));
      $objPHPExcel->getActiveSheet()->SetCellValue('Y' . $rowCount, mb_strtoupper($row1['distict_name'], 'UTF-8'));
      $objPHPExcel->getActiveSheet()->SetCellValue('Z' . $rowCount, mb_strtoupper($row1['pv_name'], 'UTF-8'));
      $objPHPExcel->getActiveSheet()->SetCellValue('AA' . $rowCount, mb_strtoupper('LA', 'UTF-8'));
      $objPHPExcel->getActiveSheet()->SetCellValue('AB' . $rowCount, mb_strtoupper('Y', 'UTF-8'));
      $objPHPExcel->getActiveSheet()->SetCellValue('AC' . $rowCount, mb_strtoupper($row1['date_register'], 'UTF-8'));
      $objPHPExcel->getActiveSheet()->SetCellValue('AD' . $rowCount, mb_strtoupper($row1['identfy_number'], 'UTF-8'));
      $objPHPExcel->getActiveSheet()->SetCellValue('AE' . $rowCount, mb_strtoupper($row1['staff_contact'], 'UTF-8'));
      $objPHPExcel->getActiveSheet()->SetCellValue('AF' . $rowCount, mb_strtoupper($row1['c_eng_name'], 'UTF-8'));
      $objPHPExcel->getActiveSheet()->SetCellValue('AG' . $rowCount, mb_strtoupper($row1['c_name'], 'UTF-8'));
      $objPHPExcel->getActiveSheet()->SetCellValue('AH' . $rowCount, mb_strtoupper($row1['gender'], 'UTF-8'));
      $rowCount++;
    }
  }
} 

$objPHPExcel->getActiveSheet()->setTitle('Customer Data');


$objPHPExcel->createSheet();


$objPHPExcel->setActiveSheetIndex(1);

$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'ParentKey');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'LineNum');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'CardCode');
$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Name');

$objPHPExcel->getActiveSheet()->SetCellValue('A2', 'CardCode');
$objPHPExcel->getActiveSheet()->SetCellValue('B2', 'LineNum');
$objPHPExcel->getActiveSheet()->SetCellValue('C2', 'CardCode');
$objPHPExcel->getActiveSheet()->SetCellValue('D2', 'Name');

$rowCount2  =  3;

for ($y = 0; $y < count($_POST['check_box']); $y++) {
  $check_box2 = $_POST['check_box'][$y];


  $stmt2 = $conn->prepare("select * from tbl_customer  where c_id = '$check_box2' ");
  $stmt2->execute();
  if ($stmt2->rowCount() > 0) {
    while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {

      $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount2, mb_strtoupper($row2['c_code'], 'UTF-8'));
      $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount2, mb_strtoupper('0', 'UTF-8'));
      $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount2, mb_strtoupper($row2['c_code'], 'UTF-8'));
      $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount2, mb_strtoupper($row2['c_name'], 'UTF-8'));
      $rowCount2++;
    }
  }
}



// Rename 2nd sheet
$objPHPExcel->getActiveSheet()->setTitle('Active Data');




$objWriter  =  new PHPExcel_Writer_Excel2007($objPHPExcel);


header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="Add-Customer.xlsx"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
?>
