<?php
include("../setting/checksession.php");
include("../setting/conn.php");

extract($_POST);



$delete_data = $conn->query(" delete from tbl_customer_order_cart where customer_order_cart_id = '$cart_id' ");
if ($delete_data) {
    $res = array("res" => "success");
} else {
    $res = array("res" => "failed");
}


echo json_encode($res);
?>