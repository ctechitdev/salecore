<?php

include("../setting/checksession.php");

include("../setting/conn.php");

extract($_POST);

if (empty($Acc_id)) {

	$res = array("res" => "noCusGroup");
} else {

	if (empty($customRadio)) {
		$customRadio = 0;
	}
	if (empty($CashType)) {
		$CashType = "";
	}
	if (empty($creditvalues)) {
		$creditvalues = 0;
	}

	$checkitem = $conn->query("SELECT  * FROM tbl_account_company  where company_code = '$Acc_id'  ")->fetch(PDO::FETCH_ASSOC);
	$code_lenght = $checkitem['code_lenght'];
	$com_code_type = $checkitem['code_type'];

	$left_code = "$custype-$Acc_id";

	if (empty($pv_code) && $com_code_type == "pvcode") {
		$res = array("res" => "noPVCode");
	} else if (empty($pv_code) && $com_code_type == "teamcode") {
		$res = array("res" => "NoTeam");
	} else { 

		$last_ref = $conn->query("select max(ref_number)+1 as lastref from tbl_customer ")->fetch(PDO::FETCH_ASSOC);
		$lref = $last_ref['lastref'];

		if (empty($pv_code)) {


			$checkitem = $conn->query("SELECT  max(last_number)+1 as last_number 
			FROM tbl_customer 
			where cus_type = '$custype' and acc_code ='$Acc_id'  
			")->fetch(PDO::FETCH_ASSOC);

			if (!empty($checkitem['last_number'])) {
				$last_number = $checkitem['last_number'];
			} else {
				$last_number = "1";
			}

			$gen_number = str_pad($last_number, $code_lenght, '0', STR_PAD_LEFT);

			if($Acc_id == '579'){
				$rc_check = "KPD$gen_number";
			}else{
				$rc_check = "$gen_number";
			}
			
		} else {

			$checkitem = $conn->query("SELECT  max(last_number)+1 as last_number 
			FROM tbl_customer 
			where cus_type = '$custype' and acc_code ='$Acc_id' and pv_team_code ='$pv_code'
			")->fetch(PDO::FETCH_ASSOC);

			if (!empty($checkitem['last_number'])) {
				$last_number = $checkitem['last_number'];
			} else {
				$last_number = "1";
			}

			$gen_number = str_pad($last_number, $code_lenght, '0', STR_PAD_LEFT);

			$rc_check = "$pv_code-$gen_number";
		}


		$right_code = "$rc_check";

		$full_code = "$left_code-$right_code";

		$insCourse = $conn->query("insert into tbl_customer
	 (c_code,cus_type,acc_code,pv_team_code,last_number,c_shop_name,gender,c_name,c_eng_name,provinces,district,village,street,h_unit,h_number,identfy_number,
	 location_des,phone1,phone2,fax,payment_type,credit_values,payment_term,contact_by,contact_phone,staff_contact, shop_type,service_type,visit_days,c_zone,
	 c_class,pl_id,date_register,add_by,ref_number,acc_book,bank_code,ccy,bank_acc_name) 
	 values ('$full_code','$custype',$Acc_id,'$pv_code','$last_number','$shopname','$customRadio','$customername','$engname','$pv_id','$dis_id','$villagename','$streetname','$houseunit','$housenumber',
	 '$identid','$locationdetail','$phone1','$phone2','$fax','$CashType','$creditvalues','$paymentterm','$contactby','$contactphone','$ss_id','$shopttypecus','$servicetype','$visitdays',
	 '$cuszone','$cusclass','$pricelist',now(), '$id_users','$lref','$acc_book','$bank_code','$currency','$acc_name') ");
		if ($insCourse) {
			$res = array("res" => "success");
		} else {
			$res = array("res" => "invalid");
		}
	}
}


echo json_encode($res);
