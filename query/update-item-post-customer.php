<?php
include("../setting/checksession.php");

include("../setting/conn.php");

extract($_POST);



$item_row = $conn->query("select * from tbl_item_code_list where icl_id = '$item_id' ")->fetch(PDO::FETCH_ASSOC);

$b1_code = $item_row['full_code'];
$item_name = $item_row['item_name'];
$item_company_code_id = $item_row['com_code'];
 
if(empty($item_status_sale)){
	$item_status_sale = 0;
}

if (!empty($_FILES['profile_pic']['name'])) {

	if ($oldpic_profile != '') {
		unlink('../images/item_post/' . $oldpic_profile);
	}

	$filename = uniqid('IMG-', true) . basename($_FILES['profile_pic']['name']);


	$location = "../images/item_post/" . $filename;
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



$insert = $conn->query("
update tbl_item_post_customer set 
item_post_pic = '$filename',
item_code_list_id = '$item_id',
item_company_code_id = '$item_company_code_id',
full_code = '$b1_code' ,
item_name = '$item_name',
item_pack_sale = '$sale_unit',
item_price = '$item_price' ,
item_status_sale = '$item_status_sale'

where item_post_customer_id = '$item_post_id'


");
if ($insert) {
	$res = array("res" => "success");
} else {
	$res = array("res" => "failed");
}


echo json_encode($res);
