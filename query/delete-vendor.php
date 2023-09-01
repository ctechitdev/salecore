<?php
include("../setting/conn.php");
extract($_POST);



$delete_vendor = $conn->query("DELETE  FROM tbl_vendor WHERE vendor_id='$id'  ");
if ($delete_vendor) {
    $delete_account = $conn->query("DELETE  FROM tbl_vendor_bank_account WHERE vendor_id='$id'  ");


    if ($delete_account) {
        $res = array("res" => "success");
    } else {

        $res = array("res" => "failed");
    }
} else {
    $res = array("res" => "failed");
}


echo json_encode($res);
