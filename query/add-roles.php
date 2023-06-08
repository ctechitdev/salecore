<?php 
include("../setting/checksession.php");

include("../setting/conn.php");

 extract($_POST);
 

 
	$insCourse = $conn->query("INSERT INTO tbl_roles (role_name ) VALUES('$role_name') ");
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