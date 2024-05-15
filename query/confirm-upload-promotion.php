<?php
include("../setting/conn.php");

extract($_POST);



$update_bill = $conn->query("update tbl_promotion set 
active_status_id = '2'
    WHERE promotion_id = '$promotion_id'  ");


if ($update_bill) {

    $res = array("res" => "success");
} else {
    $res = array("res" => "failed");
}





echo json_encode($res);
