<?php
include("../setting/checksession.php");

include("../setting/conn.php");
extract($_POST);


if ($customer_status_id == 3) {
	$update = $conn->query(" update tbl_customer_user set customer_status = '$customer_status_id' , customer_user_password ='123'  WHERE customer_user_id = '$customer_user_id'  ");
} else {
	$update = $conn->query(" update tbl_customer_user set customer_status = '$customer_status_id'  WHERE customer_user_id = '$customer_user_id'  ");
}


if ($update) {
	$res = array("res" => "success");
} else {
	$res = array("res" => "failed");
}


echo json_encode($res);
