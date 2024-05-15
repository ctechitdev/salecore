<?php
include("../setting/conn.php");

extract($_POST);


$sql = $conn->query("select * from tbl_promotion where promotion_id  = '$promotion_id' and active_status_id = '2' ");
$sql->execute();
if ($sql->rowCount() > 0) {
    $res = array("res" => "used");
} else {


    $delete_bill = $conn->query("DELETE  FROM tbl_promotion WHERE promotion_id = '$promotion_id'  ");
    if ($delete_bill) {

        $delete_detail = $conn->query("DELETE  FROM tbl_promotion_detail WHERE promotion_id = '$promotion_id'  ");


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
