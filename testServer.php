
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
		
	} else if($_GET['action'] == 'test'){
		$sql = "select MAX(id)  test values(2, 'admin', '1999-01-01');";
		$response = pg_query($link, $sql);
		$sql = "insert into test values(2, 'admin', '1999-01-01');";
		$response = pg_query($link, $sql);
		echo $response;
	}
	echo json_encode($result[0]);
?>
