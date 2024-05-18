<?php
include("../setting/checksession.php");

include("../setting/conn.php");

extract($_POST);


$item_row = $conn->query(" call stp_check_stock_add_cart('$item_code','$pack_type_name'); ")->fetch(PDO::FETCH_ASSOC);

$remain = $item_row['remain'];

if ($remain < $order_values) {
    $res = array("res" => "over");
} else if ($order_values <= 0) {
    $res = array("res" => "nozero");
} else {



    $promotion_type_id = 4;
    $total_price_order = $sale_price * $order_values;
    $discount_percent = 0;
    $discount_price = 0;


    $check_item = $conn->query("select * from tbl_customer_order_cart where item_code = '$item_code' and pack_type_name = '$pack_type_name' and add_by = '$id_users' ")->fetch(PDO::FETCH_ASSOC);


    if (empty($check_item['customer_order_cart_id'])) {



        $check_pro = $conn->query(" SELECT  *
            FROM tbl_promotion_detail 
            WHERE item_code_buy ='$item_code' and pack_type_name_buy = '$pack_type_name' and buy_values <=  '$order_values' 
            and buy_values = (select max(buy_values) from tbl_promotion_detail where item_code_buy ='$item_code' and pack_type_name_buy = '$pack_type_name' and buy_values <=  '$order_values' ) ")->fetch(PDO::FETCH_ASSOC);

        if (!empty($check_pro['promotion_id'])) {

            $item_code_pro = $check_pro['item_code_pro'];
            $pack_type_name_pro = $check_pro['pack_type_name_pro'];
            $promotion_values = $check_pro['promotion_values'];
            $promotion_type_pro = $check_pro['promotion_type_pro'];


            if ($promotion_type_pro == 1) {
                $insert_pro = $conn->query(" INSERT INTO tbl_customer_order_cart (item_code,pack_type_name,sale_price,discount_percent,discount_price,order_values,total_price_order,promotion_type_id, add_by,add_date)
                    VALUES('$item_code_pro','$pack_type_name_pro','0','0','0','$promotion_values','0','1','$id_users',CURDATE()) ");
            } else if (($promotion_type_pro == 2)) {

                $promotion_type_id = $promotion_type_pro;
                $discount_price = ($total_price_order * $promotion_values) / 100;
                $discount_percent = $promotion_values;
                $total_price_order = $total_price_order - ($discount_price);
            } else if (($promotion_type_pro == 3)) {
                $promotion_type_id = $promotion_type_pro;
                $total_price_order = $total_price_order - $promotion_values;

                $promotion_type_id = $promotion_type_pro;
                $discount_price =  $promotion_values;
                $discount_percent = 0;
                $total_price_order = $total_price_order - ($discount_price);
            }
        }

        $insert_cart = $conn->query(" insert into tbl_customer_order_cart ( item_code,pack_type_name,sale_price,discount_percent,discount_price,order_values,total_price_order,promotion_type_id,add_by,add_date )
        value ('$item_code','$pack_type_name','$sale_price','$discount_percent','$discount_price','$order_values','$total_price_order','$promotion_type_id','$id_users',now()) ");
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
            $total_price_order = $new_values * $sale_price;


            $check_pro = $conn->query(" SELECT  *
            FROM tbl_promotion_detail 
            WHERE item_code_buy ='$item_code' and pack_type_name_buy = '$pack_type_name' and buy_values <=  '$new_values' 
            and buy_values = (select max(buy_values) from tbl_promotion_detail where item_code_buy ='$item_code' and pack_type_name_buy = '$pack_type_name' and buy_values <=  '$new_values' ) ")->fetch(PDO::FETCH_ASSOC);

            if (!empty($check_pro['promotion_id'])) {

                $item_code_pro = $check_pro['item_code_pro'];
                $pack_type_name_pro = $check_pro['pack_type_name_pro'];
                $promotion_values = $check_pro['promotion_values'];
                $promotion_type_pro = $check_pro['promotion_type_pro'];


                if ($promotion_type_pro == 1) {

                    $check_pro_item = $conn->query(" SELECT  *
                    FROM tbl_promotion_detail 
                    WHERE item_code_buy ='$item_code_pro' and pack_type_name_buy = '$pack_type_name_pro' and buy_values <=  '$new_values' 
                    and buy_values = (select max(buy_values) from tbl_promotion_detail where item_code_buy ='$item_code_pro' and pack_type_name_buy = '$pack_type_name_pro' and buy_values <=  '$new_values' ) ")->fetch(PDO::FETCH_ASSOC);
        
                    if (!empty($check_pro_item['promotion_id'])) {

                        $delete_pro = $conn->query(" delete from tbl_customer_order_cart where item_code ='$item_code_pro' and pack_type_name = '$pack_type_name_pro' and promotion_type_id = '1' ");

                        $insert_pro = $conn->query(" INSERT INTO tbl_customer_order_cart (item_code,pack_type_name,sale_price,discount_percent,discount_price,order_values,total_price_order,promotion_type_id, add_by,add_date)
                        VALUES('$item_code_pro','$pack_type_name_pro','0','0','0','$promotion_values','0','1','$id_users',CURDATE()) ");
                    }

              
                } else if (($promotion_type_pro == 2)) {

                    $promotion_type_id = $promotion_type_pro;
                    $discount_price = ($total_price_order * $promotion_values) / 100;
                    $discount_percent = $promotion_values;
                    $total_price_order = $total_price_order - ($discount_price);
                } else if (($promotion_type_pro == 3)) {
                    $promotion_type_id = $promotion_type_pro;
                    $total_price_order = $total_price_order - $promotion_values;

                    $promotion_type_id = $promotion_type_pro;
                    $discount_price =  $promotion_values;
                    $discount_percent = 0;
                    $total_price_order = $total_price_order - ($discount_price);
                }
            }

            $update_cart = $conn->query(" update tbl_customer_order_cart set
            order_values = '$new_values' , total_price_order = '$total_price_order' 
            where item_code = '$item_code' and pack_type_name = '$pack_type_name' and add_by = '$id_users' and promotion_type_id = '4' ");

            if ($update_cart) {
                $res = array("res" => "success");
            } else {
                $res = array("res" => "failed");
            }
        }
    }
}





echo json_encode($res);
