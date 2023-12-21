<?php
include("../setting/checksession.php");

include("../setting/conn.php");

extract($_POST);


$delprole = $conn->query("DELETE  FROM tbl_customer_product_used WHERE customer_user_id= '$customer_user_id'  ");
if ($delprole) {




    $counitem = count($_POST['itemcheck']);

    for ($i = 0; $i < ($counitem); $i++) {
        extract($_POST);

        $insertdpitem = $conn->query("INSERT INTO tbl_customer_product_used (customer_user_id,item_company_code_id,add_by,date_add) 
        VALUES('$customer_user_id','$itemcheck[$i]','$id_users',now() )  ");
        if ($insertdpitem) {
            $res = array("res" => "success");
        } else {
            $res = array("res" => "failed");
        }
    }
}

echo json_encode($res);
?>