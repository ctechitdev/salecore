<?php 
include("../setting/checksession.php");

include("../setting/conn.php");

 extract($_POST);
 

 
	$insCourse = $conn->query("INSERT INTO tbl_depart (dp_name,group_id ) VALUES('$depart_name','$com_group') ");
	if($insCourse)
	{
		$res = array("res" => "success" );
	}
	else
	{
		$res = array("res" => "failed" );
	}
 



 echo json_encode($res);
 ?>