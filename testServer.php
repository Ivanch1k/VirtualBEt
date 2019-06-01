<?php
	$link = pg_connect(getenv("DATABASE_URL"));
	if($link == false){
		echo'Fault connection';
		return;
	}
	
	if($_GET['action'] != null){	
		if($_GET['action'] == 'SeyHello'){
			print(json_encode("Hello"));
		}
	}
	
?>
