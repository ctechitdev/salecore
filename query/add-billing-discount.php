<?php
include("../setting/checksession.php");

include("../setting/conn.php");

extract($_POST);


$selCourse = $conn->query("SELECT * FROM tbl_billing_discount 
WHERE item_company_code_id = '$item_group_code' and billing_buy_values ='$billing_buy_values' and active_date <= '$active_date' and expire_date >= '$expire_date' ");

if ($selCourse->rowCount() > 0) {
    $res = array("res" => "exist");
} else {

    $insert_data = $conn->query("INSERT INTO tbl_billing_discount
    (billing_discount_name,promotion_type_id,billing_buy_values,billing_discount_values,item_company_code_id,active_status_id,active_date,expire_date,add_date,add_by)
    VALUES
    ('$billing_discount_name','$promotion_type_id','$billing_buy_values','$billing_discount_values','$item_group_code','2','$active_date','$expire_date',now(),'$id_users') ");
    if ($insert_data) {
        $res = array("res" => "success");
    } else {
        $res = array("res" => "failed");
    }
}




echo json_encode($res);
