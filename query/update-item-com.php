<?php
include("../setting/checksession.php");

include("../setting/conn.php");
 


$counitem = count($_POST['icc_id']);

for ($i = 0; $i < ($counitem); $i++) {
    extract($_POST);

    $insCourse = $conn->query("update tbl_item_company_code set
    name_company = '$name_company[$i]',item_company_code = '$item_company_code[$i]',item_group_code_b1 = '$item_group_code_b1[$i]',
    customer_item_code = '$customer_item_code[$i]', purchase_tax_code = '$purchase_tax_code[$i]',sale_tax_code = '$sale_tax_code[$i]',
    company_code = '$company_code[$i]',gen_style = '$gen_style[$i]',apc_style = '$apc_style[$i]',apc_style = '$apc_style[$i]'
    where icc_id ='$icc_id[$i]'
    ");
    if ($insCourse) {
        $res = array("res" => "success");
    } else {
        $res = array("res" => "failed");
    }
}


echo json_encode($res);
