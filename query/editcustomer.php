<?php
include("../setting/conn.php");
 extract($_POST);


 if(empty($customRadio)){
	 $customRadio = 0;
 }
 if(empty($CashType)){
	 $CashType = 0;
 }
if(empty($creditvalues)){
	 $creditvalues = 0;
 }
 
$updCourse = $conn->query(" UPDATE tbl_customer SET 
	c_shop_name = '$shopname' ,
	gender = '$customRadio',
	c_name = '$customername' ,
	c_eng_name = '$engname' ,
	provinces = '$pv_id' ,
	district = '$dis_id' ,
	village = '$villagename' ,
	street = '$streetname' ,
	h_unit = '$houseunit' ,
	h_number = '$housenumber' ,
	identfy_number = '$identid' ,
	location_des = '$locationdetail' ,
	phone1 = '$phone1' ,
	phone2 = '$phone2' ,
	fax = '$fax' ,
	payment_type = '$CashType' ,
	credit_values = '$creditvalues' ,
	payment_term = '$paymentterm' ,
	contact_by = '$contactby' ,
	contact_phone = '$contactphone' ,
	staff_contact = '$ss_id' ,
	shop_type = '$shopttypecus' ,
	service_type = '$servicetype' ,
	visit_days = '$visitdays',
	c_zone = '$cuszone' ,
	c_class = '$cusclass',
	pl_id = '$pricelist',
	acc_book = '$acc_book',
	bank_code = '$bank_code',
	ccy = '$currency',
	bank_acc_name = '$acc_name'
 WHERE c_id='$cid' ");

if($updCourse)
{
	   $res = array("res" => "success");
}
else
{
	   $res = array("res" => "failed");
}



 echo json_encode($res);	
?>