<?php

include("../setting/checksession.php");

include("../setting/conn.php");



$item_group_code 	= $_POST['item_group_code']; 
$ccy 	= $_POST['ccy'];

$date_request = $_POST['date_request'];

$use_date = str_replace('/', '-', $date_request);
$date_use = date('Y-m-d', strtotime($use_date));





if (empty($item_group_code)) {

	$res = array("res" => "invalid");
} else {




	$insCourse = $conn->query(" insert into tbl_item_code ( icc_id,pl_id,date_use,ccy,add_by,date_register) values ('$item_group_code','13','$date_use','$ccy','$id_users',now()) ");
	$lastid = $conn->lastInsertId();

    $stmt3 = $conn->prepare(" select company_code,item_company_code,gen_style,apc_style from tbl_item_company_code where icc_id = '$item_group_code' ");

	$stmt3->execute();
	if ($stmt3->rowCount() > 0) {
		while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {

			$item_company_code = $row3['item_company_code'];
			 
		}
	}

	$countbox = count($_POST['itemcode']);

	if ($insCourse) {




		for ($i = 0; $i < ($countbox); $i++) {

			extract($_POST);

			  
		   
			$insertItem = $conn->query(" insert into tbl_item_code_list (com_code,it_id,full_code,item_header_code,item_code,item_name,
			item_price,buy_unit,sale_unit,pack,weight,date_register,item_price_purchase,brand_name,bu_group,bu_unit,ma_group,article_group) 
		values ('$item_group_code','$lastid','$itemcode[$i]','$item_company_code','$itemcode[$i]','$itemname[$i]',
		'$item_price_base[$i]','$buy_unit[$i]','$sale_unit[$i]','$pack[$i]','$weight[$i]',now(), '$item_price_pur[$i]','$brand_name[$i]',
        '$bu_group[$i]','$bu_unit[$i]','$ma_group[$i]','$article_group[$i]'
    ); ");
		 
	}



		$res = array("res" => "success");
	} else {
		$res = array("res" => "invalid");
	}
}


echo json_encode($res);

?>