<?php 
	$link = pg_connect(getenv("DATABASE_URL"));
	if($link == false){
		echo'Fault connection';
		return;
	}

	$sql = "select * from test_table";
	$result = pg_query($link, $sql);
	$res = pg_fetch_all($result);
	$Finded = false;
	foreach($res as $a){
		if($a['login'] == $_GET['login']){
			if($a['password'] == $_GET['password']){
				echo "Glade to see you again, $_GET['login']!";
				$Finded =  true;
			}else{
				echo 'Oops. Passwodr is incorrect.';		
			}
		}
	}
	if(!$Finded){
		echo "We don't meet before, $_GET['login']";
	}
?>
