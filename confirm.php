<?php 
	$link = 0;
	$link = pg_connect(getenv("DATABASE_URL"));
	if($link == false){
		echo'Fault connection';
		return;
	}

	$sql = "insert into test_table values(2, 'Ivanchik', '1234')";
	pg_query($link, $sql);
	$sql = "select all from test_table";
	$result = pg_query($link, $sql);
	
	$res = pg_fetch_all($result);
	print_r($res);
	print_r($result);
?>
