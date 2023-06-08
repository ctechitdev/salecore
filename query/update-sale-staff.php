<?php 
include("../setting/checksession.php");

include("../setting/conn.php");
 extract($_POST);

 

$delExam = $conn->query(" update tbl_staff_sale set 
staff_code ='$ss_code' ,staff_cp = '$ss_cp' ,
staff_name = '$ss_name' , user_ids = '$us_id' 
   WHERE ss_id='$ss_id'  ");
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