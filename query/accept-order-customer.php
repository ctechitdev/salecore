<?php
include("../setting/checksession.php");

include("../setting/conn.php");
 

 
    extract($_POST);

    $insCourse = $conn->query("update tbl_customer_order set order_status = 2 where customer_order_id = '$customer_order_id' ");
    if ($insCourse) {
        $res = array("res" => "success");
    } else {
        $res = array("res" => "failed");
    } 


echo json_encode($res);
