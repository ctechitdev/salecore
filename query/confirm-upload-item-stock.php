<?php
include("../setting/conn.php");

extract($_POST);



$update_bill = $conn->query("update tbl_stock_bill set 
    status_bill_id = '2'
    WHERE stock_bill_id = '$stock_bill_id'  ");


if ($update_bill) {

    $res = array("res" => "success");
} else {
    $res = array("res" => "failed");
}





echo json_encode($res);
