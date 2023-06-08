<?php
include("../setting/checksession.php");

include("../setting/conn.php");
 

 
    extract($_POST);

    $insCourse = $conn->query("update tbl_shell_bill_order set sbo_b1_status = 1 where sbo_id = '$bill_id' ");
    if ($insCourse) {
        $res = array("res" => "success");
    } else {
        $res = array("res" => "failed");
    } 


echo json_encode($res);
