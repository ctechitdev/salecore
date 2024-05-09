<?php

include("../setting/checksession.php");
include("../setting/conn.php");


extract($_POST);

$left_code = date("YmdHis");
$righer_code = $id_users;

$ref_code = "$left_code$righer_code";


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
    $pack_type_name = $row[2];
    $new_sale_price = $row[3];



    if (is_numeric($new_sale_price)) {

        // header bill stock out 
        $stock_out = $conn->query(" select * from tbl_item_price_sale where item_code = '$item_code' and pack_type_name = '$pack_type_name' ")->fetch(PDO::FETCH_ASSOC);

        if (empty($stock_out['item_price_sale_id'])) {

            $sql_query = $conn->query(" 
            insert into tbl_item_price_sale (item_code,sale_price,pack_type_name,add_by,date_add,update_by,update_date) values
            ('$item_code','$new_sale_price','$pack_type_name','$id_users',now(),'$id_users',now())   ");

        } else {
            
            $sql_query = $conn->query(" 
            update tbl_item_price_sale set
            sale_price = '$new_sale_price', update_by = '$id_users' , update_date = now()
            where item_code = '$item_code' and pack_type_name = '$pack_type_name'   ");
        }
    }
}

unlink($targetDirectory);





echo json_encode(array("statusCode" => "success"));
