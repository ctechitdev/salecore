<?php
include("../setting/checksession.php");

include("../setting/conn.php");

extract($_POST);



$insert_cart = $conn->query(" insert into tbl_customer_order_cart (item_post_id,add_by) value ('$item_post_id','$id_users') ");
if ($insert_cart) {
    $res = array("res" => "success");
} else {
    $res = array("res" => "failed");
}




echo json_encode($res);
