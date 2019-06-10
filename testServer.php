<?php	
	$link = pg_connect(getenv("DATABASE_URL"));
	if($link == false){
		echo json_encode('status=connection_failed');
		return;
	} else if($_GET['action'] == 'login'){
		$sql = "select * from client where Mail='".$_GET['login']."' and Pass='".$_GET['password']."';";
		
		$response = pg_query($link, $sql);
		if($response != ''){
			$result = pg_fetch_all($response);
		} else {
			//echo 'empty';
		}
		
		echo json_encode($result[0]);
		
	} else if($_GET['action'] == 'matches'){
		$sql = "select * from match1";
		
		$response = pg_query($link, $sql);
		if($response != ''){
			$result = pg_fetch_all($response);
		} else {
			//echo 'empty';
		}		
		echo json_encode($result);
	} else if($_GET['action'] == 'insert'){
		$sql = "INSERT INTO client(Name, SecondName, DateOfBirth, Mail, PhoneNumber, Pass, Balance) VALUES('name','secondName','1999-01-01','email','number','pass',300);";
		if(!$sql){
			echo('Insern returns false');
		}
		$response = pg_query($link, $sql);
		if($response != ''){
			$result = pg_fetch_all($response);
		} else {
			//echo 'empty';
		}		
		
	}
	
?>
