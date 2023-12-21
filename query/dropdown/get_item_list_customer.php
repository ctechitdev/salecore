<?php

include("../../setting/checksession.php");
include("../../setting/conn.php");

$stmt1 = $conn->prepare("
select icl_id, concat(item_name, ' ລາຄາ ', item_price) as item_name
from tbl_customer_product_used a
left join tbl_item_code_list b on a.item_company_code_id = b.com_code
where customer_user_id = '$id_users' and show_customer_status_id ='1'
order by item_name  ");
$stmt1->execute();

$data = $stmt1->fetchAll();

echo json_encode($data);
