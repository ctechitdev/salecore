<?php 
include("../setting/checksession.php");

include("../setting/conn.php");

 extract($_POST);
 

 $selCourse = $conn->query("SELECT * FROM tbl_user_staff WHERE user_name='$staffuser' ");

 if($selCourse->rowCount() > 0)
 {
	$res = array("res" => "exist", "user name" => $staffuser);
 }
 else
 {
    
	$insCourse = $conn->query("INSERT INTO tbl_user_staff(full_name,user_name,user_password,user_status,role_id,depart_id,date_register)
	VALUES('$staffname','$staffuser','123','1','$r_id','$dp_id',now()) ");
	if($insCourse)
	{
		$res = array("res" => "success", "user name" => $staffuser);
	}
	else
	{
		$res = array("res" => "failed", "user name" => $staffuser);
	}


 }




 echo json_encode($res);
 ?>