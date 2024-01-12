<?php
include("../setting/checksession.php");

include("../setting/conn.php");

extract($_POST);

$item_row = $conn->query("select * from tbl_item_post_customer where item_post_customer_id = '$item_post_id' ")->fetch(PDO::FETCH_ASSOC);

$item_name = $item_row['item_name'];
$item_price = $item_row['item_price']; 
$item_code_list_id = $item_row['item_code_list_id']; 
$item_pack_sale = $item_row['item_pack_sale']; 


$total_price = $item_price * $item_value;

$insert_cart = $conn->query(" insert into tbl_customer_order_cart ( item_post_id,item_code_list_id,item_name,item_pack_sale,price_per_item,item_values,total_price,add_by,add_date )
 value ('$item_post_id','$item_code_list_id','$item_name','$item_pack_sale','$item_price','$item_value','$total_price','$id_users',now() ) ");
if ($insert_cart) {
    $res = array("res" => "success");
} else {
    $res = array("res" => "failed");
}




echo json_encode($res);
