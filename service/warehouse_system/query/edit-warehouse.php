<?php 

include("../../../setting/checksession.php");

include("../setting/connect_warehouse_system.php");

 extract($_POST);
 

 $selCourse = $conn_warehouse->query("SELECT * FROM tbl_warehouse WHERE wh_code='$wh_code' and wh_id !='$wh_id'");

 if($selCourse->rowCount() > 0)
 {
	$res = array("res" => "exist");
 }
 else
 {
	$insCourse = $conn_warehouse->query("
    update tbl_warehouse set
    wh_name ='$wh_name',wh_code='$wh_code' , wh_province = '$pv_id' ,wh_district = '$dis_id' ,wh_village = '$village'
    where wh_id ='$wh_id'

    ");
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