<?php 
session_start();
 include("../setting/conn.php");
 

extract($_POST);

$selAcc = $conn->query("SELECT * FROM tbl_user_staff WHERE user_name='$username' AND user_password='$pass'  ");
$selAccRow = $selAcc->fetch(PDO::FETCH_ASSOC);


if($selAcc->rowCount() > 0)
{
	if($selAccRow['user_status'] == 2){
		 $res = array("res" => "inactive");
	}else{
		$_SESSION['id_users'] =   $selAccRow['usid'] ;
		$_SESSION['full_name'] =   $selAccRow['full_name'] ; 
		$_SESSION['role_id'] =   $selAccRow['role_id'] ; 
		$_SESSION['depart_id'] =   $selAccRow['depart_id'] ; 
		$res = array("res" => "success");
		
	}
	
	


}
else
{
  $res = array("res" => "invalid");
}




 echo json_encode($res);
 ?>