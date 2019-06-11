
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
		$sql = "select * from client where Mail='".$_GET['login']."' and Pass='".$_GET['password']."';";
		$response = pg_fetch_all(pg_query($link, $sql));
		echo $response;
		if($response == "null"){
			$sql = "select MAX(id) from client;";
			$response = pg_fetch_all(pg_query($link, $sql));
			$responce += 1;
			$sql = "insert into client values(".$response.", '".$_GET['name']."', '".$_GET['surname']."', '".$_GET['dateOfBirth']."', '".$_GET['login']."', '', '".$_GET['password']."', '', 1000);";
			$response = pg_query($link, $sql);
			if(!$response){
				echo '{"status":"0"}';
				return;
			}
		} else if(!$response){
			echo 'error in sql';
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
	}
	echo json_encode($result[0]);
?>
