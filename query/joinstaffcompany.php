<?php 
 include("../setting/checksession.php");
 include("../setting/conn.php");

 extract($_POST);
 

 $selCourse = $conn->query("SELECT * FROM tbl_staff_company WHERE user_id='$staff_id' and company_code ='$Acc_id' ");

 if($selCourse->rowCount() > 0)
 {
	$res = array("res" => "exist", "user name" => $staff_id);
 }
 else
 {
    
	$insCourse = $conn->query("INSERT INTO tbl_staff_company(company_code,user_id,date_register) VALUES('$Acc_id','$staff_id',now()) ");
	if($insCourse)
	{
		$res = array("res" => "success", "user name" => $staff_id);
	}
	else
	{
		$res = array("res" => "failed", "user name" => $staff_id);
	}


 }




 echo json_encode($res);
 ?>