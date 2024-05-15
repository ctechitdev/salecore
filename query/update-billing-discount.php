<?php
include("../setting/checksession.php");

include("../setting/conn.php");

extract($_POST);


$selCourse = $conn->query("SELECT * FROM tbl_billing_discount 
WHERE item_company_code_id = '$item_group_code' and billing_buy_values ='$billing_buy_values' and billing_discount_id != '$billing_discount_id' ");

if ($selCourse->rowCount() > 0) {
    $res = array("res" => "exist");
} else {

    $insert_data = $conn->query("
    update tbl_billing_discount set
    billing_discount_name = '$billing_discount_name', promotion_type_id = '$promotion_type_id', 
    billing_buy_values = '$billing_buy_values', billing_discount_values = '$billing_discount_values',
    item_company_code_id = '$item_group_code',  active_status_id = '$active_status_id' ,
    active_date = '$active_date' , expire_date = '$expire_date', add_by ='$id_users' 
    where billing_discount_id = '$billing_discount_id' ");
    if ($insert_data) {
        $res = array("res" => "success");
    } else {
        $res = array("res" => "failed");
    }
}




echo json_encode($res);
