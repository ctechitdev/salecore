<?php 
include("../setting/checksession.php");
 extract($_POST);

 

$delExam = $conn->query("DELETE  FROM tbl_staff_item_code WHERE sic_id='$id'  ");
if($delExam)
{
	$res = array("res" => "success");
}
else
{
	$res = array("res" => "failed");
}


	echo json_encode($res);
 ?>