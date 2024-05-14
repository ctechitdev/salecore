<?php
session_start();
include("../setting/conn.php");


extract($_POST);

$selAcc = $conn->query("SELECT * FROM tbl_user_staff WHERE user_name='$username' AND user_password='$pass'  ");
$selAccRow = $selAcc->fetch(PDO::FETCH_ASSOC);


if ($selAcc->rowCount() > 0) {
	if ($selAccRow['user_status'] == 2) {
		$res = array("res" => "inactive");
	} else {

		$_SESSION['id_users'] =   $selAccRow['usid'];
		$_SESSION['full_name'] =   $selAccRow['full_name'];
		$_SESSION['role_id'] =   $selAccRow['role_id'];
		$_SESSION['depart_id'] =   $selAccRow['depart_id'];
		$_SESSION['user_type'] =   1;


		if ($selAccRow['user_status'] == 1) {
			$res = array("res" => "success");
		} else {
			$res = array("res" => "reset");
		}
	}
} else {

	$sql_cus = $conn->query("SELECT * FROM tbl_customer_user WHERE customer_user_name='$username' AND customer_user_password='$pass'  ");
	$sql_cus_row = $sql_cus->fetch(PDO::FETCH_ASSOC);


	if ($sql_cus->rowCount() > 0) {
		if ($sql_cus_row['customer_status'] == 2) {
			$res = array("res" => "inactive");
		} else {
			$_SESSION['user_type'] =   2;

			$_SESSION['id_users'] =   $sql_cus_row['customer_user_id'];
			$_SESSION['full_name'] =   $sql_cus_row['customer_name'];
			$_SESSION['role_id'] =   $sql_cus_row['role_id'];
			$_SESSION['depart_id'] =  $sql_cus_row['company_depart_id'];  

			if ($sql_cus_row['customer_status'] == 1) {
				$res = array("res" => "success");
			}else{
				$res = array("res" => "reset");
			}

		
		}
	} else {
		$res = array("res" => "invalid");
	}
}




echo json_encode($res);
