<?php
include("../setting/checksession.php");


include("../setting/conn.php");
extract($_POST);


$date_now = date("Y-m-d");
$time_now = date("H:i:s");


if ((empty($customRadio)) and (empty($comment_box))) {

    $res = array("res" => "NoType");
} else {
    if ((empty($customRadio)) and (!empty($comment_box))) {

         

        $sqlci = "SELECT * FROM tbl_visited_customer  where cus_code = '$vd_id' and check_by = '$id_users' and date_check = curdate() and lat_in is not null ";
        $resultci = $conn->prepare($sqlci);
        $resultci->execute();

        if ($resultci->rowCount() >= 1) {
            $updatesql = $conn->query("
            update tbl_visited_customer set
            time_check_out =now() ,lat_out = '$lat_data',lon_out = '$long_data',comment_talk ='ທົດລອງ'
            where cus_code ='$vd_id' and date_check =  curdate()  ");

            if ($updatesql) {
                $res = array("res" => "successcomment");
            } else {
                $res = array("res" => "failed");
            }
        } else {


            $res = array("res" => "nocheckin");
        }

    } else {
        if ($customRadio == 'in') {
            $sql = "SELECT * FROM tbl_visited_customer  where cus_code = '$vd_id' and check_by = '$id_users' and date_check = curdate() and lat_in is not null ";
        } else {
            $sql = "SELECT * FROM tbl_visited_customer  where cus_code = '$vd_id' and check_by = '$id_users' and date_check = curdate() and lat_out is not null ";
        }



        $result = $conn->prepare($sql);


        $result->execute();


        if ($result->rowCount() >= 1) {
            $res = array("res" => "already");
        } elseif ($result->rowCount() == 0) {

            if ($customRadio == 'in') {
                $insertsql = $conn->query("insert into tbl_visited_customer (cus_code,date_check,time_check_in,check_by,lat_in,lon_in,comment_talk) 
                values ('$vd_id',now(),now(),'$id_users','$lat_data','$long_data','$comment_box')  ");
                if ($insertsql) {
                    $res = array("res" => "success");
                } else {
                    $res = array("res" => "failed");
                }
            } else {


                $sqlci = "SELECT * FROM tbl_visited_customer  where cus_code = '$vd_id' and check_by = '$id_users' and date_check = curdate() and lat_in is not null ";
                $resultci = $conn->prepare($sqlci);
                $resultci->execute();

                if ($resultci->rowCount() >= 1) {
                    $updatesql = $conn->query("
                    update tbl_visited_customer set
                    time_check_out =now() ,lat_out = '$lat_data',lon_out = '$long_data',comment_talk ='$comment_box'
                    where cus_code ='$vd_id' and date_check =  curdate()  ");

                    if ($updatesql) {
                        $res = array("res" => "successout");
                    } else {
                        $res = array("res" => "failed");
                    }
                } else {


                    $res = array("res" => "nocheckin");
                }
            }
        } else {
            $res = array("res" => "failed");
        }
    }
}






echo json_encode($res);
