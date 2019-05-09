<?php 
	$link = 0;
	$link = pg_connect(getenv("DATABASE_URL"));
	
	print_r($link);	

	$sql = "select all from test_table;";
	$result = pg_query($link, $sql);
	$res = pg_fetch_all($result);
	print_r($res);
?>
