<?php
include("../setting/checksession.php");

include("../setting/conn.php");

extract($_POST);





if (!empty($_FILES['profile_pic']['name'])) {

    if ($oldpic_profile != '') {
        unlink('../images/promotion_picture/' . $oldpic_profile);
    }

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
} else {
    $filename = $oldpic_profile;
}

if (!empty($picture_status)) {
    $filename = "";
}


$update_data = $conn->query("
update tbl_promotion_promote set 

promotion_promote_picture= '$filename',
item_company_code_id= '$item_company_code_id',
active_status_id= '$active_status_id',
active_date= '$active_date',expire_date = '$expire_date'
where promotion_promote_id = '$promotion_promote_id'  ");
if ($update_data) {
    $res = array("res" => "success");
} else {
    $res = array("res" => "failed");
}


echo json_encode($res);
