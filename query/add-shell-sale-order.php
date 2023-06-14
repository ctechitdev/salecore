<?php

include("../setting/checksession.php");
include("../setting/conn.php");



$countbox = count($_POST['item_name']);

$box_values = "no";
$check_price = "yes";

$data_box_values = "";

$data_price = "";

$remain_status = "";
$item_no = "";


for ($a = 0; $a < ($countbox); $a++) {
    extract($_POST);
    if (($item_value[$a] == "") or ($item_name[$a] == "")) {
        $box_values = "yes";
        $b = $a + 1;
        $data_box_values = $data_box_values . ' ' . $b;
    }
}



if ($box_values == "yes") {
    $res = array("res" => "novalue", "list_value" => "$data_box_values");
} else if (empty($paytype)) {
    $res = array("res" => "nopaytype");
} else if (($paytype == 1) and (empty($cashtype))) {
    $res = array("res" => "nocashtype");
} else if (($paytype == 1) and ($ccy == "")) {
    $res = array("res" => "noccy");
}else if (($paytype == 2) and ($credit_day <= 0 )) {
    $res = array("res" => "nocreditday");
} else {

    if ($paytype == 1) {
        $credit_day = 0; 
    }
    $gbrow = $conn->query(" SELECT count(sbo_id)+1 as count_bill FROM tbl_shell_bill_order
    where date_register =  CURDATE()   ")->fetch(PDO::FETCH_ASSOC);


    if ($gbrow['count_bill'] == null) {
        $bill_count = 1;
    } else {
        $bill_count  = $gbrow['count_bill'];
    }
    $right_code = str_pad($bill_count, 4, '0', STR_PAD_LEFT);
    $gendate_number = date("Ymd");

    $bill_number = "$gendate_number$right_code";


    $insertbill = $conn->query(" 
        insert into tbl_shell_bill_order (cus_code,sbo_number,sbo_status,sbo_type,sbo_ccy,credit_day,order_by,date_register) 
        values ('$cus_code_order','$bill_number','$paytype','$cashtype','$ccy','$credit_day','$id_users',CURDATE())
          ");

    $last_bill = $conn->lastInsertId();

    $bill_price = 0;
    if ($insertbill) {
        for ($i = 0; $i < ($countbox); $i++) {

            extract($_POST);
            $total_price = $item_price[$i] * $item_value[$i];


            $insertbilldetail = $conn->query(" 
    insert into tbl_shell_sale_order ( sbo_id,item_name,item_unit,item_price,item_total_price,item_cate_type,order_by,date_register) 
    values ('$last_bill','$item_name[$i]','$item_value[$i]','$item_price[$i]','$total_price','$sale_unit[$i]','$id_users',CURDATE())
      ");

            $bill_price += $total_price;
        }
    }

    $update = $conn->query("update tbl_shell_bill_order set sbo_price = '$bill_price' where sbo_id ='$last_bill' ");



    $res = array("res" => "success");
}



echo json_encode($res);
