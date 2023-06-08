 

<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "kpwarehouse";
 
try {
  $conn_warehouse = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
  
  $conn_warehouse_system = true;
} catch(PDOException $e) {
  $conn_warehouse_system = false;
}
?>