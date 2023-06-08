<?php 
include("../setting/checksession.php");
 extract($_POST);

 

$delExam = $conn->query("DELETE  FROM tbl_staff_company WHERE sc_id='$id'  ");
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