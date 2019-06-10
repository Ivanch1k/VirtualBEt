<?php
session_start();
echo "asdasd";
$mysql = pg_connect(getenv("DATABASE_URL"));



$mail = $_POST['mail'];
$name = $_POST['name'];
$secondName = $_POST['secondName'];

$userIdMails = pq_query($mysql,"SELECT * FROM client");

$counter = 0;
foreach ($userIdMails as $userIdMail){
    if($userIdMail['Mail'] == $mail){
        $counter++;
        $userId = $userIdMail['Id'];
    }
}

if($counter == 0) {
    pq_query($mysql,"INSERT INTO client(Name, SecondName, Mail, Balance) VALUES('$name','$secondName','$mail',300);");
}

$result = pq_query($mysql,"SELECT * FROM client WHERE Mail = '$mail';");
while(($row = $result->fetch_assoc()) != false){
    $user = $row;
}
$_SESSION["loggedUser"] = $user;