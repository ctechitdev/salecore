<?php 
include("../setting/conn.php");
 extract($_POST);

 

$delitemheader = $conn->query("DELETE  FROM tbl_item_code WHERE it_id='$id'  ");
if($delitemheader)
{
	$delitemlist = $conn->query("DELETE  FROM tbl_item_code_list WHERE it_id='$id'  ");
	 
	
	$res = array("res" => "success");
}
else
{
	$res = array("res" => "failed");
}


	echo json_encode($res);
 ?>