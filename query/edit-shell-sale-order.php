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
} else {

    if ($paytype == 2) {
        $cashtype = 0;
        $ccy = "ccy";
    }
    $gbrow = $conn->query(" SELECT count(sbo_id)+1 as count_bill FROM tbl_shell_bill_order
    where date_register =  CURDATE() and  order_by ='$id_users' ")->fetch(PDO::FETCH_ASSOC);


    if ($gbrow['count_bill'] == null) {
        $bill_count = 1;
    } else {
        $bill_count  = $gbrow['count_bill'];
    }
    $right_code = str_pad($bill_count, 4, '0', STR_PAD_LEFT);
    $gendate_number = date("Ymd");

    $bill_number = "$gendate_number$right_code";


    $updatebill = $conn->query(" 
    update  tbl_shell_bill_order 
    set    
    sbo_status = '$paytype',
    sbo_type = '$cashtype',
    sbo_ccy = '$ccy'
    where sbo_id = '$bill_id'  ");
    if ($updatebill) {
        $delorder = $conn->query(" delete from tbl_shell_sale_order where sbo_id = '$bill_id' ");

        if ($delorder) {

            $bill_price = 0;
            for ($i = 0; $i < ($countbox); $i++) {

                extract($_POST);

                $price_item = $total_price[$i] / $item_value[$i];

                $insertbill = $conn->query(" 
            insert into tbl_shell_sale_order ( sbo_id,item_name,item_unit,item_price,item_total_price,item_cate_type,order_by,date_register) 
            values ('$bill_id','$item_name[$i]','$item_value[$i]','$price_item','$total_price[$i]','$sale_unit[$i]','$id_users',CURDATE())
              ");
                $bill_price += $total_price[$i];
            }

            $update = $conn->query("update tbl_shell_bill_order set sbo_price = '$bill_price' where sbo_id ='$bill_id' ");
            $res = array("res" => "success");
        }
    }
}



echo json_encode($res);
