<?php

include("../setting/checksession.php");

include("../setting/conn.php");

extract($_POST);



$update_vendor = $conn->query(" update tbl_vendor 
set 
vendor_name = '$contact_name', vendor_shop_name = '$shopname', company_register_code = '$company_reg_number', vat_register_code = '$vat_reg_number',
phone_office = '$phone_office', phone_mobile = '$phone_mobile', email = '$email', province_name = '$province_name', district_name = '$district_name',
village = '$village_name', contact_type = '$contactRadio' , contact_expire_date = '$contact_expire_date', cash_type = '$cashRadio'
where vendor_id = '$vendor_id' ");




if ($update_vendor) {


    $clear_data = $conn->query(" delete from tbl_vendor_bank_account where vendor_id = '$vendor_id' ");



    $countbox = count($_POST['ccy']);

    for ($i = 0; $i < ($countbox); $i++) {

        $insertItem = $conn->query(" insert into tbl_vendor_bank_account (vendor_id,account_currency,bank_name,bank_account_name,bank_account_number)
		 values 
		 ('$vendor_id','$ccy[$i]','$bank_code[$i]','$bank_account_name[$i]','$bank_account_number[$i]') ");


        $res = array("res" => "success");
    }
} else {
    $res = array("res" => "invalid");
}




echo json_encode($res);
