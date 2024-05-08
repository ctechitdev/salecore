<?php
include("../setting/checksession.php");

include("../setting/conn.php");

extract($_POST);


$item_row = $conn->query(" call stp_check_stock_add_cart('$item_code','$pack_type_name'); ")->fetch(PDO::FETCH_ASSOC);

$remain = $item_row['remain'];

if ($remain < $order_values) {
    $res = array("res" => "over");
}else if($order_values <= 0 ){
    $res = array("res" => "nozero");
} else {



    $check_item = $conn->query("select * from tbl_customer_order_cart where item_code = '$item_code' and pack_type_name = '$pack_type_name' and add_by = '$id_users' ")->fetch(PDO::FETCH_ASSOC);


    if (empty($check_item['customer_order_cart_id'])) {

        $total_price_order = $sale_price * $order_values;

        $insert_cart = $conn->query(" insert into tbl_customer_order_cart ( item_code,pack_type_name,sale_price,order_values,total_price_order,add_by,add_date )
        value ('$item_code','$pack_type_name','$sale_price','$order_values','$total_price_order','$id_users',now()) ");
        if ($insert_cart) {
            $res = array("res" => "success");
        } else {
            $res = array("res" => "failed");
        }
    } else {



        $new_values = $check_item['order_values'] + $order_values;


        if ($remain < $new_values) {
            $res = array("res" => "over");
        } else {
            $total_price_order = $new_values * $order_values;

            $update_cart = $conn->query(" update tbl_customer_order_cart set
            order_values = '$new_values' , total_price_order = '$total_price_order' 
            where item_code = '$item_code' and pack_type_name = '$pack_type_name' and add_by = '$id_users' ");

            if ($update_cart) {
                $res = array("res" => "success");
            } else {
                $res = array("res" => "failed");
            }
        }
    }
}






echo json_encode($res);
