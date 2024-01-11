<?php
include("../setting/checksession.php");

include("../setting/conn.php");

extract($_POST);


$item_row = $conn->query("select * from tbl_item_code_list where icl_id = '$item_id' ")->fetch(PDO::FETCH_ASSOC);

$b1_code = $item_row['full_code'];
$item_name = $item_row['item_name'];
$item_company_code_id = $item_row['com_code'];

if (!empty($_FILES['pic_item']['name'])) {
	$filename = uniqid('IMG-', true) . basename($_FILES['pic_item']['name']);
	 
	
	$location = "../images/item_post/" . $filename;
	$extension = pathinfo($location, PATHINFO_EXTENSION);
	$extension = strtolower($extension);
	$allowed_extensions = array("jpg", "jpeg", "png");
	if (in_array(strtolower($extension), $allowed_extensions)) {
		move_uploaded_file($_FILES['pic_item']['tmp_name'], $location);
	} else {
			$res = array("res" => "failed");
		exit;
	}
} else {
	$filename = null;
}



$insert = $conn->query("INSERT INTO tbl_item_post_customer (item_post_pic,item_code_list_id, item_company_code_id ,full_code ,
 item_name , item_pack_sale,item_status_sale, item_price,add_by,add_date) 
values ('$filename','$item_id','$item_company_code_id','$b1_code','$item_name','$sale_unit','1','$item_price','$id_users',now()) ");
if ($insert) {
	$res = array("res" => "success");
} else {
	$res = array("res" => "failed");
}
 

echo json_encode($res);
