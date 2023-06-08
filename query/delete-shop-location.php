<?php 
include("../setting/conn.php");
 extract($_POST);


 $row = $conn->query(" SELECT shop_pic FROM  tbl_shop_customer_location where scl_id = '$id' ")->fetch(PDO::FETCH_ASSOC);
    
	 
        $picture_name = $row['shop_pic']; 

        
 

$delExam = $conn->query("DELETE  FROM tbl_shop_customer_location WHERE scl_id  ='$id'  ");
if($delExam)
{

    unlink("../images/shop/$picture_name");
	$res = array("res" => "success");
}
else
{
	$res = array("res" => "failed");
}


	echo json_encode($res);
 ?>