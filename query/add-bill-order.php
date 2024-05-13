<?php
include("../setting/checksession.php");

include("../setting/conn.php");

extract($_POST);

$check_remain = 0;

$stmt1 = $conn->prepare(" call stp_check_stock_add_bill('$id_users');");
$stmt1->execute();
if ($stmt1->rowCount() > 0) {
    while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {

        if ($row1['remain_values'] <= 0) {
            $check_remain++;
        }
    }
}

if ($check_remain > 0) {
    $res = array("res" => "nostock");
} else {

    $conn = null;
    include("../setting/conn.php");

    // header bill stock out 
    $stock_out = $conn->query(" SELECT count(stock_bill_id)+1 as last_number 
    FROM tbl_stock_bill
    where date(add_date) =  CURRENT_DATE ")->fetch(PDO::FETCH_ASSOC);

    if (empty($stock_out['last_number'])) {
        $last_num = 1;
    } else {
        $last_num  = $stock_out['last_number'];
    }

    $right_code = str_pad($last_num, 4, '0', STR_PAD_LEFT);

    $gendate_number = date("Ymd");

    $ref_bill = "KPPO$gendate_number$right_code";

    $header_bill_out = $conn->query(" insert into tbl_stock_bill  (stock_bill_number,stock_type_id,status_bill_id,add_by,add_date) 
    values ('$ref_bill','2','1','$id_users',now()); ");

    $stock_bill_id = $conn->lastInsertId();

    if ($header_bill_out) {

        $stock_out_detail = $conn->query("  
        INSERT INTO tbl_stock_bill_detail (stock_bill_id,warehouse_id,item_code,credit_value,debit_value,pack_type_name,stock_type_id,add_by,add_date)
        select  '$stock_bill_id' as stock_bill_id,'1' as warehouse_id,item_code,'0' as credit_value,order_values as debit_value ,pack_type_name, '2' as stock_type_id,'$id_users' as add_by, now() as add_date
        from tbl_customer_order_cart 
        where add_by = '$id_users' ");

        if ($stock_out_detail) {

            // header bill stock out 
            $bill_header = $conn->query(" SELECT count(customer_order_id)+1 as last_number 
            FROM tbl_customer_order
            where order_date =  CURRENT_DATE ")->fetch(PDO::FETCH_ASSOC);

            if (empty($stock_out['last_number'])) {
                $last_num = 1;
            } else {
                $last_num  = $stock_out['last_number'];
            }

            $right_code = str_pad($last_num, 4, '0', STR_PAD_LEFT);

            $gendate_number = date("Ymd");

            $price_bill = "KP$gendate_number$right_code";

            $order_bill = $conn->query(" insert into tbl_customer_order  (customer_order_bill,stock_bill_id,total_price,order_status,order_by,order_date) 
            values ('$price_bill','$stock_bill_id','$total_sale_cart','1','$id_users',now()); ");




            $order_bill_id = $conn->lastInsertId();

            if ($order_bill) {
                $bill_price_detail = $conn->query("  
                INSERT INTO tbl_customer_order_detail (customer_order_id,item_code,pack_type_name,sale_price,order_values,total_price_order,order_by,date_order)
                select  '$order_bill_id' as customer_order_id,item_code,pack_type_name,sale_price, order_values , total_price_order ,'$id_users' as add_by, now() as add_date
                from tbl_customer_order_cart 
                where add_by = '$id_users' ");


                if ($bill_price_detail) {
                    $clear_cart = $conn->query(" delete from tbl_customer_order_cart where add_by = '$id_users' ");

                    if ($bill_price_detail) {

                        $data_message = "test noti";


                        $url = 'https://notify-api.line.me/api/notify';
                        $token      = " line no ti code ";
                        $headers    = [
                            'Content-Type: application/x-www-form-urlencoded',
                            'Authorization: Bearer ' . $token
                        ];
                        $fields     = "message= $data_message ";

                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        $result = curl_exec($ch);
                        curl_close($ch);



                        echo json_encode(array("statusCode" => "success"));
                    }
                }
            }
        }
    }
}
