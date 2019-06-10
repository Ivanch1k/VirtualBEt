
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
			$sql = "insert into client values('".$_GET['name']."', '".$_GET['surname']."', '".$_GET['dateOfBirth']."', '".$_GET['login']."', '".$_GET['password']."');";
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
	}
	echo json_encode($result[0]);
?>
