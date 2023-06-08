<?php

include("../setting/checksession.php");

include("../setting/conn.php");


$path = '../images/shop/';

extract($_POST);


 


$stmt3 = $conn->prepare(" SELECT  *  FROM  tbl_shop_customer_location  where cus_code ='$cus_code' ");
$stmt3->execute();
if ($stmt3->rowCount() > 0) {
    while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {
         

        $pic_shop = $row3['shop_pic'];
        $scl_id = $row3['scl_id'];
    }
}



$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // v

$img = $_FILES['shop_pic']['name'];
$tmp = $_FILES['shop_pic']['tmp_name'];




$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));


if (empty($pic_shop)) {
    $row = $conn->query(" SELECT (max(scl_id))+1  as numpic FROM  tbl_shop_customer_location ")->fetch(PDO::FETCH_ASSOC);
    $mainnum = $row['numpic'];

    if (empty($mainnum)) {
        $mainnum = 1;
    }
    $final_image = $mainnum . "." . $ext;
} else {
    $final_image = $pic_shop;
}



if (in_array($ext, $valid_extensions)) {
    $path = $path . strtolower($final_image);
    if (move_uploaded_file($tmp, $path)) {

        if (empty($scl_id)) {
            $insCourse = $conn->query("insert into tbl_shop_customer_location (cus_code,shop_pic,lat,lon,add_by,add_date) 
            values ('$cus_code','$final_image','$lat_data','$long_data','$id_users',now()) ");
            if ($insCourse) {
                $res = array("res" => "success");
            } else {
                $res = array("res" => "invalid");
            }
        } else {
            $updatesql = $conn->query("
            update tbl_shop_customer_location set
            shop_pic ='$final_image' , lat = '$lat_data',lon = '$long_data'
            where cus_code ='$cus_code' ");

            if ($updatesql) {

                $res = array("res" => "successupdate");
            } else {
                $res = array("res" => "failed");
            }
        }
    } else {
        $res = array("res" => "imgerror");
    }
} else {
    $res = array("res" => "nopic");
}





echo json_encode($res);
