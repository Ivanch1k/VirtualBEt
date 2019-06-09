<?php
session_start();

$mysql = new mysqli("localhost","root","","virtualbet");
if ($mysql->connect_errno) {
    printf("Не удалось подключиться: %s\n", $mysql->connect_error);
    exit();
}
$mysql->query("SET NAMES 'utf-8");

$user = $_SESSION["loggedUser"]["Id"];
$number =  "+380".$_POST['number'];

// номер телефона уже зареган в базе
$client = $mysql->query("SELECT * FROM client WHERE PhoneNumber = '$number';");
$numberCounter = 0;
foreach ($client as $c){
    $numberCounter++;
}
//

if($numberCounter > 0){
    echo "NumberExistException";
}else{
    $mysql->query("UPDATE client SET PhoneNumber = '$number' WHERE Id = $user");
}