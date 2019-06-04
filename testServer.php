<?php	
	if($_GET['login'] == 'Admin'){
		$result["login"] = "Admin";
		$result["password"] = "It's work!!!";
	} else if($_GET['login'] == 'Neadmin'){
		$result["login"] = "Admin";
		$result["password"] = "It's work tooo!!!";
	}
	echo json_encode($result);
?>
