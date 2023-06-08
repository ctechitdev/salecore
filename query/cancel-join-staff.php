<?php
include("../setting/checksession.php");

include("../setting/conn.php");
extract($_POST);

$delExam = $conn->query(" update tbl_staff_sale set user_ids = null WHERE ss_id='$id'  ");
if ($delExam) {
    $res = array("res" => "success");
} else {
    $res = array("res" => "failed");
}

echo json_encode($res);

?>