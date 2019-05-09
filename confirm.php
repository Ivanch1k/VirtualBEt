<?php 
	$link = 0;
	$link = pg_connect(getenv("DATABASE_URL"));
	
	if($link == 0){
		echo'Cannot connect to database';
		return;
	}
	
	$sql = "select all from test_table";
	$result = pg_query($link, $sql);

	echo $result;
?>
