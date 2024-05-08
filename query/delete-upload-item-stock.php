<?php
include("../setting/conn.php");

extract($_POST);


$sql = $conn->query("select * from tbl_stock_bill where stock_bill_id  = '$stock_bill_id' and status_bill_id = '2' ");
$sql->execute();
if ($sql->rowCount() > 0) {
    $res = array("res" => "used");
} else {


    $delete_bill = $conn->query("DELETE  FROM tbl_stock_bill WHERE stock_bill_id = '$stock_bill_id'  ");
    if ($delete_bill) {

        $delete_detail = $conn->query("DELETE  FROM tbl_stock_bill_detail WHERE stock_bill_id = '$stock_bill_id'  ");


        if ($delete_detail) {

            $res = array("res" => "success");
        } else {
            $res = array("res" => "failed");
        }
    } else {
        $res = array("res" => "failed");
    }
}



echo json_encode($res);
