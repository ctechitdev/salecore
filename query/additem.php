<?php

include("../setting/checksession.php");

include("../setting/conn.php");



$item_group_code 	= $_POST['item_group_code'];
$price_list 	= $_POST['price_list'];
$ccy 	= $_POST['ccy'];

$date_request = $_POST['date_request'];

$use_date = str_replace('/', '-', $date_request);
$date_use = date('Y-m-d', strtotime($use_date));





if (empty($item_group_code)) {

	$res = array("res" => "invalid");
} else {




	$insCourse = $conn->query(" insert into tbl_item_code ( icc_id,pl_id,date_use,ccy,add_by,date_register) values ('$item_group_code','$price_list','$date_use','$ccy','$id_users',now()) ");
	$lastid = $conn->lastInsertId();

	$stmt3 = $conn->prepare(" select company_code,item_company_code,gen_style,apc_style from tbl_item_company_code where icc_id = '$item_group_code' ");

	$stmt3->execute();
	if ($stmt3->rowCount() > 0) {
		while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {

			$item_company_code = $row3['item_company_code'];
			//$company_code = $row3['company_code'];
			
			$att_code = $row3['gen_style'];
			$legn_code = $row3['apc_style'];
		}
	}
	if ($att_code == 'None' || $att_code == 'NoneDash') {
		$last_left_code = "";
	} else {
		$last_left_code = $att_code;
	}



	$countbox = count($_POST['itemcode']);

	if ($insCourse) {




		for ($i = 0; $i < ($countbox); $i++) {

			extract($_POST);

			// generade left code
			$stmt2 = $conn->prepare("  SELECT  (max(last_code )+1)  AS count_code FROM tbl_item_code_list where  item_header_code = '$item_company_code' ");

			$stmt2->execute();
			if ($stmt2->rowCount() > 0) {
				while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {


					$last_num = $row2['count_code'];
					$gen_number = str_pad($last_num, 3, '0', STR_PAD_LEFT);
					$left_code = "$item_company_code$gen_number$last_left_code";

					
				}
			} 

			if(empty($last_num)){
				$last_num  = 1;
			}


			// end  generade left code

			// generade right code 

			if ($item_company_code == '53') {

				$cp_right_code = str_pad($last_num, $legn_code, '0', STR_PAD_LEFT);
				$right_code = "CP$cp_right_code";

				$left_code = "$item_company_code$gen_number$last_left_code";
				 
			}elseif($item_company_code == 'KP'){

				$right_code = str_pad($last_num, $legn_code, '0', STR_PAD_LEFT);


				if(!empty($itemcode[$i])){
					$gen_left_code = $itemcode[$i];
					$left_code ="$gen_left_code$last_left_code";
				} 
				$itemcode[$i] = $left_code;
				
			}elseif($item_company_code == '13'){ 
				$right_code = $itemcode[$i];

			} else {
				$gen_right_code = str_pad($itemcode[$i], $legn_code, '0', STR_PAD_LEFT);
				$right_code = $gen_right_code;
			}

			// end generade right code

			if ($att_code == 'NoneDash') {
				$full_code = "$left_code$right_code";
			} else {
				$full_code = "$left_code-$right_code";
			}


			$insertItem = $conn->query(" insert into tbl_item_code_list (com_code,it_id,full_code,last_code,item_header_code,item_code,item_name,
			item_price,buy_unit,sale_unit,pack,weight,date_register,brand_name ) 
		values ('$item_group_code','$lastid','$full_code','$last_num','$item_company_code','$itemcode[$i]','$itemname[$i]','$item_price[$i]',
		'$buy_unit[$i]','$sale_unit[$i]','$pack[$i]','$weight[$i]',now(),'$brand_name[$i]'); ");
		
	}



		$res = array("res" => "success");
	} else {
		$res = array("res" => "invalid");
	}
}





echo json_encode($res);
