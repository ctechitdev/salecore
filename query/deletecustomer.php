<?php 
 include("../setting/conn.php");
 extract($_POST);

 

$delExam = $conn->query("DELETE  FROM tbl_customer WHERE c_id='$id'  ");
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