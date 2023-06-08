<?php 
include("../setting/checksession.php");

 include("../setting/conn.php");

 extract($_POST);
 

 $selCourse = $conn->query("SELECT * FROM tbl_staff_item_code WHERE use_by ='$staff_id' and icc_id ='$icc_id' ");

 if($selCourse->rowCount() > 0)
 {
	$res = array("res" => "exist", "user name" => $staff_id);
 }
 else
 {
    
	$insCourse = $conn->query("INSERT INTO tbl_staff_item_code(icc_id,use_by,date_register) VALUES('$icc_id','$staff_id',now()) ");
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