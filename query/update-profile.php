<?php
include("../setting/checksession.php");

include("../setting/conn.php");

extract($_POST);

if ($user_type_id == 1) {
    if ($user_password == "") {
        $update_data = $conn->query("update tbl_user_staff set full_name = '$new_full_name'  where usid = '$id_users'  ");
        if ($update_data) {
            $res = array("res" => "success");
        } else {
            $res = array("res" => "failed");
        }
    } else {
        $update_data = $conn->query("update tbl_user_staff set user_password = '$user_password' , user_status = '1' where usid = '$id_users'  ");
        if ($update_data) {
            $res = array("res" => "success");
        } else {
            $res = array("res" => "failed");
        }
    }
} else {

    if ($user_password == "") {
        $update_data = $conn->query("update tbl_customer_user set customer_name = '$new_full_name'  where customer_user_id = '$id_users'  ");
        if ($update_data) {
            $res = array("res" => "success");
        } else {
            $res = array("res" => "failed");
        }
    } else {
        $update_data = $conn->query("update tbl_customer_user set customer_user_password = '$user_password' , customer_status = '1' where customer_user_id = '$id_users'  ");
        if ($update_data) {
            $res = array("res" => "success");
        } else {
            $res = array("res" => "failed");
        }
    }
}






echo json_encode($res);
