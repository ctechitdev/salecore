<?php

include("../setting/checksession.php");
include("../setting/conn.php");


extract($_POST);

// header bill stock out 
$countrow = $conn->query(" SELECT count(stock_bill_id)+1 as last_number 
 FROM tbl_stock_bill
 where date(add_date) =  CURRENT_DATE ")->fetch(PDO::FETCH_ASSOC);

if (empty($countrow['last_number'])) {
    $last_num = 1;
} else {
    $last_num  = $countrow['last_number'];
}

$right_code = str_pad($last_num, 4, '0', STR_PAD_LEFT);

$gendate_number = date("Ymd");

$ref_bill = "KPITF$gendate_number$right_code";

$insert_header = $conn->query(" insert into tbl_stock_bill  (stock_bill_number,stock_type_id,status_bill_id,add_by,add_date) 
 values ('$ref_bill','1','1','$id_users',now()); ");

$stock_bill_id = $conn->lastInsertId();






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
    $item_code = $row[0];
    $item_values = $row[4];
    $pack_name = $row[2];

    if (is_numeric($item_values)) {
        $insert = $conn->query(" INSERT INTO tbl_stock_bill_detail ( stock_bill_id,warehouse_id,item_code,credit_value,debit_value,pack_type_name,stock_type_id,add_by,add_date) 
         VALUES('$stock_bill_id','1','$item_code','$item_values','0','$pack_name','1','$id_users',now());  ");
    }
}

unlink($targetDirectory);





echo json_encode(array("statusCode" => "success"));
