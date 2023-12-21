<?php

include("../setting/checksession.php");
include("../setting/conn.php");


extract($_POST);

$countbox = count($_POST['item_id']);

$gbrow = $conn->query(" SELECT count(customer_order_id)+1 as count_bill 
FROM tbl_customer_order
where order_date = CURDATE() ")->fetch(PDO::FETCH_ASSOC);


if ($gbrow['count_bill'] == null) {
    $bill_count = 1;
} else {
    $bill_count  = $gbrow['count_bill'];
}
$right_code = str_pad($bill_count, 4, '0', STR_PAD_LEFT);
$gendate_number = date("Ymd");

$bill_number = "$gendate_number$right_code";


$insertbill = $conn->query(" 
    insert into tbl_customer_order (customer_order_bill,order_status,order_by,order_date ) 
    values ( '$bill_number','1','$id_users',now())
      ");

$last_bill = $conn->lastInsertId();

$bill_price = 0;
if ($insertbill) {
    for ($i = 0; $i < ($countbox); $i++) {


        $item_row = $conn->query("select * from tbl_item_code_list where icl_id = '$item_id[$i]'  ")->fetch(PDO::FETCH_ASSOC);
        $item_name = $item_row['item_name'];
        $item_pack_unit = $item_row['sale_unit'];
        $item_price = $item_row['item_price'];

        $item_total_price = $item_price * $item_value[$i];



        $insertbilldetail = $conn->query("insert into tbl_customer_order_detail 
        (customer_order_id,item_code_list_id,item_name,order_values,item_pack_unit,item_price_unit,item_total_price,order_by,date_order)
        values ('$last_bill','$item_id[$i]','$item_name','$item_value[$i]','$item_pack_unit','$item_price','$item_total_price','$id_users',now() ) ");
    }
}

$update = $conn->query("update tbl_customer_order set total_price = '$item_total_price' where customer_order_id ='$last_bill' ");



$res = array("res" => "success");



echo json_encode($res);
