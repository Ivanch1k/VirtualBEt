
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
		} 
	} else if($_GET['action'] == 'regestration'){
		$sql = "select * from client where Mail='".$_GET['login']."';";
		$response = pg_fetch_all(pg_query($link, $sql));
		echo $response;
		if(!$response){
			$sql = "select MAX(id) from client;";
			$response = pg_fetch_all(pg_query($link, $sql));
			$response = $response[0][max];
			$response += 1;
			echo $response;
			$sql = "insert into client values(".$response.", '".$_GET['name']."', '".$_GET['surname']."', '".$_GET['dateOfBirth']."', '".$_GET['login']."', '', '".$_GET['password']."', '', 1000);";
			$response = pg_query($link, $sql);
			if(!$response){
				echo '{"status":"0"}';
				return;
			}
		} else if($response){
			echo 'error';
			return;
		} else{
			echo '{"status":"1"}';
			return;
		}
	} else if($_GET['action'] == 'test'){
		$sql = "select MAX(id)  test values(2, 'admin', '1999-01-01');";
		$response = pg_query($link, $sql);
		$sql = "insert into test values(2, 'admin', '1999-01-01');";
		$response = pg_query($link, $sql);
		echo $response;
	} else if($_GET['action'] == 'matches'){
		$sql = "select * from match1;";
		$response = pg_fetch_all(pg_query($link, $sql));
		echo $response;
		echo '--------';
		echo json_encode($response);
		return;
	}
	//echo json_encode($result[0]);
?>
