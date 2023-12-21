<?php
include("../setting/checksession.php");

include("../setting/conn.php");
extract($_POST);

if (empty($staff_status)) {
    $staff_status = 0;
}

if (empty($customer_status)) {
    $customer_status = 0;
}

$update_data = $conn->query(" 
update tbl_item_code_list set
show_staff_status_id = '$staff_status', show_customer_status_id = '$customer_status'
where icl_id = '$item_list_id' 
");
if ($update_data) {
    $res = array("res" => "success");
} else {
    $res = array("res" => "failed");
}


echo json_encode($res);
