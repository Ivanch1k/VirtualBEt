<?php 
	$link = pg_connect(getenv("DATABASE_URL"));
	if($link == false){
		echo'Fault connection';
		return;
	}
if($_GET['type'] == 'login'){
	

	$sql = "select * from test_table";
	$result = pg_query($link, $sql);
	$res = pg_fetch_all($result);
	$Finded = false;
	foreach($res as $a){
		if($a['login'] == $_GET['login']){
			if($a['password'] == $_GET['password']){
				echo "Glade to see you again, " . $_GET['login'] . "!";
				$Finded =  true;
			}else{
				echo 'Oops. Passwodr is incorrect.';
				$Finded = true;
			}
		}
	}
	if(!$Finded){
		echo "We dont meet before, " . $_GET['login'] . ".";
	}
}
else if($_GET['type'] == 'reg'){
	if($_GET['login'] != '' && $_GET['password'] != ''){
		$sql = "select MAX(id) from test_table";
		$nextNumber = pg_fetch_all(pg_query($link, $sql), 1);
		echo var_dump($nextNumber);
		/* $sql = "insert into test_table (id, login, password) values($nextNumber, '{$_GET['login']}', '{$_GET['password']}')";
		$result = pg_query($link, $sql);	
		$res = pg_fetch_all($result);
		var_dump($res);
		echo "Welcome to our site!"; */
	}
	else{
		echo "Login or password are empty";
	}
}
?>
