<?php

include("../setting/checksession.php");

include("../setting/conn.php");






$insCourse = $conn->query(" insert into tbl_item_edit (add_by,date_register) 
values ('$id_users',now()) ");

$countbox = count($_POST['itemid']);

if ($insCourse) {


    $lastid = $conn->lastInsertId();

    for ($i = 0; $i < ($countbox); $i++) {

        extract($_POST);

        $insertItem = $conn->query("  insert into tbl_item_edit_detail_list (ie_id,item_id,item_name,buy_unit,sale_unit,pack,weight,brand_name,date_register) 
				values ('$lastid','$itemid[$i]','$itemname[$i]','$buy_unit[$i]','$sale_unit[$i]','$pack[$i]','$weight[$i]','$brand_name[$i]', now());  ");


        $updatesql = $conn->query("  
    update tbl_item_code_list set
    item_name = '$itemname[$i]', buy_unit ='$buy_unit[$i]',sale_unit ='$sale_unit[$i]',
    pack = '$pack[$i]', weight ='$weight[$i]', brand_name ='$brand_name[$i]'
    where icl_id ='$itemid[$i]'
       ");
    }







    $res = array("res" => "success");
} else {
    $res = array("res" => "invalid");
}






echo json_encode($res);
