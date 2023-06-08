<?php 	

include("../setting/conn.php");

$com_code = $_POST['com_code'];

$stmt1 = $conn->prepare(" SELECT icl_id,item_code,concat(item_name,' (',full_code,') ' ) as item_name ,item_price,buy_unit,sale_unit,
concat(pack,'X',weight) as packing 
FROM tbl_item_code_list 
where com_code ='$com_code';
order by item_name ");
$stmt1->execute();
								
$data = $stmt1->fetchAll();
 
echo json_encode($data);


?>