<?php

include("../setting/checksession.php");

include("../setting/conn.php");


extract($_POST);


if (empty($customRadio)) {
    $customRadio = 0;
}
if (empty($CashType)) {
    $CashType = "";
}
if (empty($creditvalues)) {
    $creditvalues = 0;
}


 


	$countbox = count($_POST['custype']);






		for ($i = 0; $i < ($countbox); $i++) {

			extract($_POST);

            $checkitem = $conn->query("SELECT  * FROM tbl_account_company  where company_code = '$Acc_id[$i]'  ")->fetch(PDO::FETCH_ASSOC);
	$code_lenght = $checkitem['code_lenght'];
	$com_code_type = $checkitem['code_type'];

	$left_code = "$custype[$i]-$Acc_id[$i]";

	if (empty($pv_code[$i]) && $com_code_type == "pvcode") {
		$res = array("res" => "noPVCode");
	} else if (empty($pv_code[$i]) && $com_code_type == "teamcode") {
	 
        $show_pv_code = $Acc_id[$i];
		 
        $res = array("res" => "NoTeam", "show_pv_code" => $show_pv_code);
        break;
	}
    else { 
		$last_ref = $conn->query("select max(ref_number)+1 as lastref from tbl_customer ")->fetch(PDO::FETCH_ASSOC);
		$lref = $last_ref['lastref'];

        if (!empty($pv_code[$i]) && $com_code_type == "onlygen"){
            $pv_code[$i] = null;
        }

		if (empty($pv_code[$i])) {


			$checkitem = $conn->query("SELECT  max(last_number)+1 as last_number 
			FROM tbl_customer 
			where cus_type = '$custype[$i]' and acc_code ='$Acc_id[$i]'  
			")->fetch(PDO::FETCH_ASSOC);

			if (!empty($checkitem['last_number'])) {
				$last_number = $checkitem['last_number'];
			} else {
				$last_number = "1";
			}

			$gen_number = str_pad($last_number, $code_lenght, '0', STR_PAD_LEFT);
			$rc_check = "$gen_number";
		} else {

			$checkitem = $conn->query("SELECT  max(last_number)+1 as last_number 
			FROM tbl_customer 
			where cus_type = '$custype[$i]' and acc_code ='$Acc_id[$i]' and pv_team_code ='$pv_code[$i]'
			")->fetch(PDO::FETCH_ASSOC);

			if (!empty($checkitem['last_number'])) {
				$last_number = $checkitem['last_number'];
			} else {
				$last_number = "1";
			}

			$gen_number = str_pad($last_number, $code_lenght, '0', STR_PAD_LEFT);

			$rc_check = "$pv_code[$i]-$gen_number";
		}


		$right_code = "$rc_check";

		$full_code = "$left_code-$right_code";

		$insCourse = $conn->query("insert into tbl_customer
	 (c_code,cus_type,acc_code,pv_team_code,last_number,c_shop_name,gender,c_name,c_eng_name,provinces,district,village,street,h_unit,h_number,identfy_number,
	 location_des,phone1,phone2,fax,payment_type,credit_values,payment_term,contact_by,contact_phone,staff_contact, shop_type,service_type,visit_days,
	 c_zone,c_class,pl_id,date_register,add_by,ref_number) 
	 values ('$full_code','$custype[$i]',$Acc_id[$i],'$pv_code[$i]','$last_number','$shopname','$customRadio','$customername','$engname','$pv_id','$dis_id','$villagename','$streetname','$houseunit','$housenumber',
	 '$identid','$locationdetail','$phone1','$phone2','$fax','$CashType','$creditvalues','$paymentterm','$contactby','$contactphone','$ss_id','$shopttypecus','$servicetype','$visitdays',
	 '$cuszone','$cusclass','$pricelist',now(), '$id_users','$lref') ");
		if ($insCourse) {
			$res = array("res" => "success");
		} else {
			$res = array("res" => "invalid");
		}
	}

	   
 
}





echo json_encode($res);
