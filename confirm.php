<?php 
	$link = pg_connect(getenv("DATABASE_URL"));
	if($link == false){
		echo'Fault connection';
		return;
	}

	$sql = "select * from test_table";
	$result = pg_query($link, $sql);
	$res = pg_fetch_all($result);
	
	foreach($res as $a){
		if($a['login'] == $_GET['login']){
			echo 'Glade to see you again!';
		}
	}
	else{
		echo "We don't meet before";
	}
?>
