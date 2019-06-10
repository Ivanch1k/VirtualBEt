<?php
session_start();

$mysql = pg_connect(getenv("DATABASE_URL"));

$user = $_SESSION["loggedUser"]["Id"];
$number =  "+380".$_POST['number'];

// номер телефона уже зареган в базе
$client =  pq_query($mysql,"SELECT * FROM client WHERE PhoneNumber = '$number';");
$numberCounter = 0;
foreach ($client as $c){
    $numberCounter++;
}
//

if($numberCounter > 0){
    echo "NumberExistException";
}else{
    pq_query($mysql,"UPDATE client SET PhoneNumber = '$number' WHERE Id = $user");
}