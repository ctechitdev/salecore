<?php
include("../setting/conn.php");
extract($_POST);


$sql = $conn->query("select *  FROM tbl_customer_order_detail WHERE item_post_id = '$item_post_id'   ");
$sql->execute();
if ($sql->rowCount() > 0) {
    $res = array("res" => "exist");
} else {

    $delete = $conn->query("delete from tbl_item_post_customer where item_post_customer_id ='$item_post_id' ");


    if ($delete) {
        $res = array("res" => "success");
    } else {
        $res = array("res" => "failed");
    }
}


 


echo json_encode($res);
