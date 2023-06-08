<?php

include("../setting/conn.php");


 $pu_id = $_GET['pu_id'];

$start_date_error = '';
$end_date_error = '';
 
 
  $file_name = 'priceupdate.csv';
  
  header('Content-Encoding: UTF-8');
  header("Content-Description: File Transfer");
  header("Content-Disposition: attachment; filename=$file_name"); 
 
  
  $file = fopen('php://output', 'w');

  $header = array("ParentKey","LineNum","PriceList","Price","Currency");
  
  
  $header2 = array("ItemCode","LineNum","PriceList","Price","Currency" );

  //$header = array("Entry_date");
 fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF)); 



  fputcsv($file, $header);
  fputcsv($file, $header2);
  
 $stmt3 = $conn->prepare("  
 select full_code,price_update,ccy,(pl_id-1) as list_num,pl_id as price_list
 from tbl_price_update_list a 
 left join tbl_price_update b on a.pu_id = b.pu_id
 left join tbl_item_code_list c on a.item_id = c.icl_id
 where a.pu_id ='$pu_id'
 ");
							$stmt3->execute();
							$i = 1;
							if($stmt3->rowCount() > 0)
							{
							while($row=$stmt3->fetch(PDO::FETCH_ASSOC))
							{
								
								
							
  
   
							
							
						 
							
   $data = array();
    
   $data[] = $row["full_code"];
   $data[] = $row["list_num"];
   $data[] = $row["price_list"];
   $data[] = $row["price_update"]; 
   $data[] = $row["ccy"]; 
  fputcsv($file, $data);
  
  }
							}

 
  fclose($file);
  exit;
   

 
?>

 