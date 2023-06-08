<?php 

include("../../../setting/checksession.php");

include("../setting/connect_warehouse_system.php");

 extract($_POST);
 

 $selCourse = $conn_warehouse->query("SELECT * FROM tbl_warehouse WHERE wh_code='$wh_code' ");

 if($selCourse->rowCount() > 0)
 {
	$res = array("res" => "exist");
 }
 else
 {
	$insCourse = $conn_warehouse->query("INSERT INTO tbl_warehouse (wh_name ,wh_code,com_code,wh_province,wh_district,wh_village,add_by,date_register) 
	VALUES('$wh_name','$wh_code','$com_id','$pv_id','$dis_id','$village','$id_users',CURDATE()) ");
	if($insCourse)
	{
		$res = array("res" => "success" );
	}
	else
	{
		$res = array("res" => "failed" );
	}
 }


 echo json_encode($res);
 ?>