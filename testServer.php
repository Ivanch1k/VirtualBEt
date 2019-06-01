<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$login = $_POST['login'];
		$passwodr = $_POST['password'];
		
		$password = password_hash($passwodr, PASSWORD_DEFAULT);
		
		$result["success"] = "1";
		$result["message"] = "Finnaly Hello";
		
		echo "Hello!";
		
		echo json_encode($result);
	}
?>
