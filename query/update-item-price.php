<?php
include("../setting/checksession.php");

include("../setting/conn.php");
extract($_POST);



$update_price = $conn->query(" update tbl_item_price_sale set
sale_price = '$sale_price'
where item_code = '$item_code' and  pack_type_name = '$pack_type_name' ");
if ($update_price) {
    $res = array("res" => "success");
} else {
    $res = array("res" => "failed");
}


echo json_encode($res);
