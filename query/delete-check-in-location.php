<?php 
include("../setting/conn.php");
 extract($_POST);

 

$delExam = $conn->query("DELETE  FROM tbl_visited_customer WHERE vc_id='$id'  ");
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