<?php


include("../setting/conn.php");

extract($_POST);



$sql = $conn->query("select * 
from tbl_billing_discount 
where billing_discount_id  = '$billing_discount_id' and active_date <= CURDATE() and expire_date >= CURDATE() and active_status_id = '2' ");
$sql->execute();
if ($sql->rowCount() > 0) {
    $res = array("res" => "used");
} else {
    $delete_data = $conn->query("  delete from tbl_billing_discount where billing_discount_id = '$billing_discount_id'  ");
    if ($delete_data) {
        $res = array("res" => "success");
    } else {
        $res = array("res" => "failed");
    }
}





echo json_encode($res);
