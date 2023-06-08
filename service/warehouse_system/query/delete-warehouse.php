<?php 

include("../../../setting/checksession.php");

include("../setting/connect_warehouse_system.php");

 extract($_POST);
 

 $selCourse = $conn_warehouse->query("SELECT * FROM tbl_transfer_bill WHERE wh_id='$id' ");

 if($selCourse->rowCount() > 0)
 {
	$res = array("res" => "used");
 }
 else
 {
	$insCourse = $conn_warehouse->query("  delete from tbl_warehouse where wh_id ='$id'  ");
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