<?php

session_start();
	if($_SESSION['id_users'] == "" )
	{
	header("location:logout.php");
	}
	  else{
		$id_users = $_SESSION["id_users"];
		$full_name = $_SESSION["full_name"]; 
		$role_id = $_SESSION["role_id"]; 
		$depart_id = $_SESSION["depart_id"]; 
		
	}
 
?>