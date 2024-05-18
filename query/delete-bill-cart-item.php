<?php
include("../setting/checksession.php");
include("../setting/conn.php");

extract($_POST);


$item_data = $conn->query("select * from tbl_customer_order_cart where   customer_order_cart_id = '$cart_id' ")->fetch(PDO::FETCH_ASSOC);

if (!empty($item_data['customer_order_cart_id'])) {


    $item_code = $item_data['item_code'];
    $pack_type_name = $item_data['pack_type_name'];
    $order_values = $item_data['order_values'];
}

$check_pro = $conn->query(" SELECT  *
FROM tbl_promotion_detail 
WHERE item_code_buy ='$item_code' and pack_type_name_buy = '$pack_type_name' and buy_values <=  '$order_values' 
and buy_values = (select max(buy_values) from tbl_promotion_detail where item_code_buy ='$item_code' and pack_type_name_buy = '$pack_type_name' and buy_values <=  '$order_values' ) ")->fetch(PDO::FETCH_ASSOC);

if (!empty($check_pro['promotion_id'])) {

    $item_code_pro = $check_pro['item_code_pro'];
    $pack_type_name_pro = $check_pro['pack_type_name_pro'];
    $promotion_values = $check_pro['promotion_values'];

    $delete_pro = $conn->query(" delete from tbl_customer_order_cart where item_code ='$item_code_pro' and pack_type_name = '$pack_type_name_pro' and promotion_type_id = '1' ");

}


$delete_data = $conn->query(" delete from tbl_customer_order_cart where customer_order_cart_id = '$cart_id' ");
if ($delete_data) {
    $res = array("res" => "success");
} else {
    $res = array("res" => "failed");
}


echo json_encode($res);
