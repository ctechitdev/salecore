<?php 
include("../setting/checksession.php");

include("../setting/conn.php");

 extract($_POST);
 

 $selCourse = $conn->query("SELECT * FROM tbl_customer_user WHERE customer_user_name = '$customer_user_name' ");

 if($selCourse->rowCount() > 0)
 {
	$res = array("res" => "exist", "user name" => $customer_user_name);
 }
 else
 {
    
	$insCourse = $conn->query("INSERT INTO tbl_customer_user(customer_name,customer_user_name,customer_user_password,customer_status,role_id,add_by,add_date)
	VALUES('$customer_name','$customer_user_name','123','1','9','$id_users',now()) ");
	if($insCourse)
	{
		$res = array("res" => "success", "user name" => $customer_user_name);
	}
	else
	{
		$res = array("res" => "failed", "user name" => $customer_user_name);
	}


 }




 echo json_encode($res);
 ?>