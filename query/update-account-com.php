<?php
include("../setting/checksession.php");

include("../setting/conn.php");
 


$counitem = count($_POST['ac_ic']);

for ($i = 0; $i < ($counitem); $i++) {
    extract($_POST);

    $insCourse = $conn->query("update tbl_account_company set
    acc_number = '$acc_number[$i]',acc_name = '$acc_name[$i]',acc_code = '$acc_code[$i]',company_code  = '$company_code[$i]',
    code_type ='$code_type[$i]', code_lenght = '$code_lenght[$i]'
    where ac_ic ='$ac_ic[$i]'
    ");
    if ($insCourse) {
        $res = array("res" => "success");
    } else {
        $res = array("res" => "failed");
    }
}


echo json_encode($res);
