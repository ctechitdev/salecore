<?php 

$host = "8.219.195.25:9090";
$user = "root";
$pass = "w1gnxHCyKKBYr43";
$db   = "salecore";
$conn = null;

try {
  $conn = new PDO("mysql:host={$host};dbname={$db};",$user,$pass);
} catch (Exception $e) {
  
}
$conn -> exec("set names utf8");

 ?>