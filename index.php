<?php
	$link = pg_connect(getenv("DATABASE_URL"));
	if($link == false){
		echo json_encode('status=connection_failed');
		return;
	} else if($_GET['action'] == 'login'){
		$sql = "select * from client where Mail=".$_GET['login']." and Pass=".$_GET['password'];
		
		$response = pg_query($link, $sql);
		if($response != ''){
			echo $response;
			foreach($response as $key => $value){
		
			}
			$result = pg_fetch_all($response);
		}
	} else if($_GET['action'] == 'matches'){
		$sql = "select * from matches";
		$response = pg_query($link, $sql);
		$result = pg_fetch_all($response);
		echo $result;
	}
	echo '--------------------------';
	echo json_encode($result);
?>
