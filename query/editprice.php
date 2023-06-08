<?php 

include("../setting/checksession.php");

include("../setting/conn.php");
 
 
 $pu_id =   $_POST['edit_pu_id']; 
   
$price_list 	= $_POST['price_list']; 
$ccy 	= $_POST['ccy']; 

$date_request = $_POST['date_request']; 
 
$use_date = str_replace('/', '-', $date_request);
$date_use = date('Y-m-d', strtotime($use_date));
 
 
 



if(empty($price_list) ){
	
	$res = array("res" => "invalid" );
	
	
} else{
	
	
	
	 $updateitemheader = $conn->query(" update tbl_price_update set  pl_id = '$price_list' ,date_use = '$date_use' ,ccy = '$ccy'  WHERE pu_id = '$pu_id'    ");
if($updateitemheader)
{
	$delitemlist = $conn->query("DELETE FROM tbl_price_update_list WHERE pu_id= '$pu_id'  ");
	 
	if($delitemlist){
 
 
		$countbox =count($_POST['itemid']);  
		for ($i=0; $i<($countbox);$i++) {
			
			extract($_POST);
			
				$insertItem = $conn->query(" insert into tbl_price_update_list (pu_id,item_id,price_update,date_register ) 
		values ('$pu_id','$itemid[$i]','$item_price[$i]',now() ); ");
		if($insertItem){
			$res = array("res" => "success" );
		}else{
			$res = array("res" => "invalid" );
		}
		
		}
		 
		
	
	 
	
	
	$res = array("res" => "success" );
	}else{
		$res = array("res" => "invalid" );
	}
	
	 
}
else
{
	$res = array("res" => "failed");
}
	
 
 
 

}

 



 echo json_encode($res);
 ?>