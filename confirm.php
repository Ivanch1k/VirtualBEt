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
		$sql = "select MAX(id) from test_table group by id";
		$nextNumber = pg_query($link, $sql) + 1;
		$sql = "insert into test_table values(" . $nextNumber . ", " . $_GET['login'] . ", " . $_GET['password'] . ")";
		echo $sql;
		$result = pg_query($link, $sql);
		echo "Welcome to our site!";
	}
	echo "Login or passwort are empty";
}
?>
