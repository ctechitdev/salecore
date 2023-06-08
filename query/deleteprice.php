<?php 
include("../setting/checksession.php");
 extract($_POST);

 

$delitemheader = $conn->query("DELETE  FROM tbl_price_update WHERE pu_id='$id'  ");
if($delitemheader)
{
	$delitemlist = $conn->query("DELETE  FROM tbl_price_update_list WHERE pu_id='$id'  ");
	 
	
	$res = array("res" => "success");
}
else
{
	$res = array("res" => "failed");
}


	echo json_encode($res);
 ?>