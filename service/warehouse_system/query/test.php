<?php

include("../../../setting/checksession.php");

include("../setting/connect_shop_online.php");

$fileName = $_FILES["excel"]["name"];
$fileExtension = explode('.', $fileName);
$fileExtension = strtolower(end($fileExtension));
$newFileName = date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;

$targetDirectory = "../../../excelReader/" . $newFileName;
move_uploaded_file($_FILES['excel']['tmp_name'], $targetDirectory);

error_reporting(0);
ini_set('display_errors', 0);

require '../../../excelReader/excel_reader2.php';
require '../../../excelReader/SpreadsheetReader.php';

$reader = new SpreadsheetReader($targetDirectory);
foreach ($reader as $key => $row) {
    $item_code = $row[13];
    $item_values = $row[18];


    if ($item_code != "") {
        $insert = $conn_shop->query(" INSERT INTO tbl_item_transaction ( item_code,item_values,its_type) VALUES(  '$item_code', '$item_values', '1') ");

        if($insert){
            $res = array("res" => "success");
        }else{
            $res = array("res" => "faild");
        }
    }
}

unlink($targetDirectory);



echo json_encode($res);
?>