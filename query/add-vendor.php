<?php

include("../setting/checksession.php");

include("../setting/conn.php");

extract($_POST);

$acc_code= $conn->query("SELECT  * FROM tbl_account_company  where company_code = '$Acc_id'  ")->fetch(PDO::FETCH_ASSOC);

$vendor_code_type = $acc_code['vendor_code'];

$checkitem = $conn->query("SELECT  max(last_number)+1 as last_number 
FROM tbl_vendor 
where vendor_code_type ='$vendor_code_type'  
")->fetch(PDO::FETCH_ASSOC);

if (!empty($checkitem['last_number'])) {
	$last_number = $checkitem['last_number'];
} else {
	$last_number = "1";
}

$gen_number = str_pad($last_number, 4, '0', STR_PAD_LEFT);

$rc_check = "$vendor_code_type-$gen_number";

$insCourse = $conn->query(" insert into tbl_vendor 
(acc_code,vendor_name,vendor_shop_name,vendor_code,vendor_code_type,last_number,company_register_code,
vat_register_code,phone_office,phone_mobile,email,province_id,district_id,village,contact_type,contact_expire_date,add_by,register_date) 
values 
('$Acc_id','$contact_name','$shopname','$rc_check','$vendor_code_type','$last_number','$company_reg_number','$vat_reg_number','$phone_office','$phone_mobile','$email',
'$province_id','$dis_id','$village_name','$contactRadio','$contact_expire_date','$id_users',now()) ");
if ($insCourse) {
	$res = array("res" => "success");
} else {
	$res = array("res" => "invalid");
}



$res = array("res" => "success");

echo json_encode($res);
