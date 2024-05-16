<?php
include("../setting/checksession.php");

include("../setting/conn.php");

extract($_POST);





if (!empty($_FILES['profile_pic']['name'])) {

	if ($oldpic_profile != '') {
		unlink('../images/product_picture/' . $oldpic_profile);
	}

	$filename = uniqid('IMG-', true) . basename($_FILES['profile_pic']['name']);


	$location = "../images/product_picture/" . $filename;
	$extension = pathinfo($location, PATHINFO_EXTENSION);
	$extension = strtolower($extension);
	$allowed_extensions = array("jpg", "jpeg", "png");
	if (in_array(strtolower($extension), $allowed_extensions)) {
		move_uploaded_file($_FILES['profile_pic']['tmp_name'], $location);
	} else {
		$res = array("res" => "failed");
		exit;
	}
} else {
	$filename = $oldpic_profile;
}

if (!empty($picture_status)) {
	$filename = "";
}


$update_data = $conn->query("
update tbl_item_price_sale set 
item_picture = '$filename',
sale_price = '$sale_price'

where item_code = '$item_code' and pack_type_name = '$pack_type_name'


");
if ($update_data) {
	$res = array("res" => "success");
} else {
	$res = array("res" => "failed");
}


echo json_encode($res);
