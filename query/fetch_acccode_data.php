<?php

include("../setting/conn.php");
include("../setting/checksession.php");

$stmt1 = $conn->prepare(" SELECT company_code ,concat(company_code ,' (',acc_name, ') ') as full_code 
from tbl_staff_company a
left join tbl_account_company b on a.company_id = b.ac_ic
where depart_id = '$depart_id'
order by company_code  ");
$stmt1->execute();

$data = $stmt1->fetchAll();

echo json_encode($data);

?>