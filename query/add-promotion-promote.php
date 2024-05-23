<?php
include("../setting/checksession.php");

include("../setting/conn.php");

extract($_POST);





if (!empty($_FILES['profile_pic']['name'])) {



    $filename = uniqid('IMG-', true) . basename($_FILES['profile_pic']['name']);


    $location = "../images/promotion_picture/" . $filename;
    $extension = pathinfo($location, PATHINFO_EXTENSION);
    $extension = strtolower($extension);
    $allowed_extensions = array("jpg", "jpeg", "png");
    if (in_array(strtolower($extension), $allowed_extensions)) {
        move_uploaded_file($_FILES['profile_pic']['tmp_name'], $location);
    } else {
        $res = array("res" => "failed");
        exit;
    }
}else{
    $res = array("res" => "nopic");
}


$insert_data = $conn->query(" insert into tbl_promotion_promote (promotion_promote_picture,item_company_code_id,status_post,active_date,expire_date,add_by,date_add)
 values 
('$filename','$item_group_code','2','$active_date','$expire_date','$id_users',now()) ");
if ($insert_data) {
    $res = array("res" => "success");
} else {
    $res = array("res" => "failed");
}


echo json_encode($res);
