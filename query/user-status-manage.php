<?php
include("../setting/checksession.php");

include("../setting/conn.php");
extract($_POST);



if ($user_status == 3) {

	$update_user = $conn->query(" update tbl_user_staff set user_status = '$user_status', user_password ='123' WHERE usid='$id'  ");
	if ($update_user) {
		$res = array("res" => "success");
	} else {
		$res = array("res" => "failed");
	}
} else {

	$update_user = $conn->query(" update tbl_user_staff set user_status = '$user_status'  WHERE usid='$id'  ");
	if ($update_user) {
		$res = array("res" => "success");
	} else {
		$res = array("res" => "failed");
	}
}




echo json_encode($res);
