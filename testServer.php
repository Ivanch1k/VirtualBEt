<?php
	$login = $_POST['login'];
	$passwodr = $_POST['password'];
		
	$password = password_hash($passwodr, PASSWORD_DEFAULT);
		
	$result["success"] = "1";
	$result["message"] = "Finnaly Hello";
		
	echo json_encode($result);
	
?>
