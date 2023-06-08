<?php
include("../setting/checksession.php");

include("../setting/conn.php");

$dp_id = $_POST['dp_id'];

$delprole = $conn->query("DELETE  FROM tbl_staff_item_code WHERE use_by='$dp_id'  ");
if ($delprole) {




    $counitem = count($_POST['itemcheck']);

    for ($i = 0; $i < ($counitem); $i++) {
        extract($_POST);

        $insertdpitem = $conn->query("INSERT INTO tbl_staff_item_code (icc_id,use_by,date_register) VALUES('$itemcheck[$i]','$dp_id',now() )  ");
        if ($insertdpitem) {
            $res = array("res" => "success");
        } else {
            $res = array("res" => "failed");
        }
    }
}

echo json_encode($res);
?>