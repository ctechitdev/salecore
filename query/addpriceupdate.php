<?php 

include("../setting/checksession.php");

include("../setting/conn.php");
 
 
   
$price_list 	= $_POST['price_list']; 
$ccy 	= $_POST['ccy']; 

$date_request = $_POST['date_request']; 
 
$use_date = str_replace('/', '-', $date_request);
$date_use = date('Y-m-d', strtotime($use_date));
 
 
$com_code = $_POST['com_code']; 


if(empty($price_list) ){
	
	$res = array("res" => "nopricelist" );
	
	
} elseif ( empty($ccy)){
	$res = array("res" => "noccy" );
}else{
	
 
 
  
$insCourse = $conn->query(" insert into tbl_price_update ( pl_id,date_use,ccy,add_by,com_code,date_register) 
values ('$price_list','$date_use','$ccy','$id_users','$com_code',now()) ");

$countbox =count($_POST['itemid']);

	if($insCourse)
	{
		
		
		$lastid = $conn->lastInsertId(); 
		
		for ($i=0; $i<($countbox);$i++) {
			
			extract($_POST);
			
				$insertItem = $conn->query("  insert into tbl_price_update_list (pu_id,item_id,price_update,date_register) 
				values ('$lastid','$itemid[$i]','$item_price[$i]', now());  ");
		
		}
		
	
		
		$res = array("res" => "success" );
	}
	else
	{
		$res = array("res" => "invalid" );
	}

}

 



 echo json_encode($res);
 ?>