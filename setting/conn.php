<?php 

$host = "localhost";
$user = "root";
$pass = "";
$db   = "kpsale";
$conn = null;

try {
  $conn = new PDO("mysql:host={$host};dbname={$db};",$user,$pass);
} catch (Exception $e) {
  
}
$conn -> exec("set names utf8");

 ?>