<?php
include("../setting/checksession.php");

include("../setting/conn.php");

extract($_POST);

$countrow = $conn->query(" SELECT count(customer_order_id)+1 as last_number 
FROM tbl_customer_order
where order_date =  CURRENT_DATE and order_by = '$id_users'  ")->fetch(PDO::FETCH_ASSOC);

if (empty($countrow['last_number'])) {
    $last_num = 1;
} else {
    $last_num  = $countrow['last_number'];
}

$gendate_number = date("Ymd");
$right_code = str_pad($last_num, 4, '0', STR_PAD_LEFT);


$ref_bill = "CPO$gendate_number" .   "$right_code";


$select_sum = $conn->query(" select sum(total_price) as total_price
from tbl_customer_order_cart
where add_by = '$id_users'
group by add_by ")->fetch(PDO::FETCH_ASSOC);

$total_bill = $select_sum['total_price'];

$bill_header = $conn->query(" insert into tbl_customer_order (customer_order_bill,total_price,order_status,order_by,order_date) 
values ('$ref_bill','$total_bill','1','$id_users',now()); ");
$lastid = $conn->lastInsertId();

if ($bill_header) {
    $insert_detail = $conn->query("
    INSERT INTO tbl_customer_order_detail (customer_order_id,item_code_list_id,item_post_id,item_name,order_values,item_pack_unit,item_price_unit,item_total_price,order_by,date_order)
    
    select '$lastid' as customer_order_id,item_code_list_id,item_post_id,item_name,item_values,item_pack_sale,price_per_item,total_price,add_by,add_date
    from tbl_customer_order_cart
    where add_by = '$id_users'
     ");

    if ($insert_detail) {

        $clear_cart = $conn->query("DELETE  FROM tbl_customer_order_cart WHERE add_by = '$id_users'  ");

        if ($clear_cart) {

            $res = array("res" => "success");
        } else {
            $res = array("res" => "failed");
        }
    } else {
        $res = array("res" => "failed");
    }
}








echo json_encode($res);
