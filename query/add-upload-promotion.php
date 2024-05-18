<?php

include("../setting/checksession.php");
include("../setting/conn.php");


extract($_POST);

// header bill stock out 
$countrow = $conn->query(" SELECT count(promotion_id)+1 as last_number 
FROM tbl_promotion
where  date_add =  CURRENT_DATE ")->fetch(PDO::FETCH_ASSOC);

if (empty($countrow['last_number'])) {
    $last_num = 1;
} else {
    $last_num  = $countrow['last_number'];
}

$right_code = str_pad($last_num, 4, '0', STR_PAD_LEFT);

$gendate_number = date("Ymd");

$pro_code_title = "KPPRO$gendate_number$right_code";

$insert_header = $conn->query(" insert into tbl_promotion  (promotion_title,active_status_id,active_date,expire_date,add_by,date_add) 
 values ('$pro_code_title','1','$active_date','$expire_date','$id_users',now()); ");

$promotion_id = $conn->lastInsertId();




$fileName = $_FILES["excel"]["name"];
$fileExtension = explode('.', $fileName);
$fileExtension = strtolower(end($fileExtension));
$newFileName = date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;

$targetDirectory = "../excelReader/" . $newFileName;
move_uploaded_file($_FILES['excel']['tmp_name'], $targetDirectory);

error_reporting(0);
ini_set('display_errors', 0);

require '../excelReader/excel_reader2.php';
require '../excelReader/SpreadsheetReader.php';

$reader = new SpreadsheetReader($targetDirectory);
foreach ($reader as $key => $row) {
    $item_code_buy = $row[0];
    $pack_name_buy = $row[2]; 
    $item_values_buy = $row[3];

    $item_code_pro = $row[4];
    $pack_name_pro = $row[6];
    $promotion_type_pro = $row[7];
    $item_values_pro = $row[8];

    $payment_type_id = $row[9];


    if (is_numeric($item_values_buy)) {
        $insert = $conn->query(" INSERT INTO tbl_promotion_detail 
        (promotion_id,item_code_buy,pack_type_name_buy,buy_values,item_code_pro,pack_type_name_pro,promotion_type_pro,promotion_values,payment_type_id,active_date,expire_date) 
         VALUES('$promotion_id','$item_code_buy','$pack_name_buy','$item_values_buy','$item_code_pro','$pack_name_pro','$promotion_type_pro','$item_values_pro','$payment_type_id','$active_date','$expire_date' );  ");
    }
}

unlink($targetDirectory);





echo json_encode(array("statusCode" => "success"));
