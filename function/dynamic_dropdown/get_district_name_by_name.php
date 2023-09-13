
<?php
include('../../setting/conn.php');

$province_name = $_POST['province_name'];

echo "<option value='0'> ເລືອກເມືອງ </option>";


$stmt = $conn->prepare(" 
SELECT dis_id,distict_name
FROM tbl_districts a
left join tbl_provinces b on a.pv_id = b.pv_id
where pv_name  = '$province_name' order by distict_name  ");
$stmt->execute();
if ($stmt->rowCount() > 0) {
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
		$distict_name = $row['distict_name'];
		echo "<option value='$distict_name'>$distict_name</option>";
	}
}


?> 

