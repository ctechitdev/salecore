<?php 	

include("../../setting/conn.php");

$stmt1 = $conn->prepare(" select * from tbl_bank_code ");
$stmt1->execute();
								
$data = $stmt1->fetchAll();
 
echo json_encode($data);


?>