<?php
session_start();

$mysql = pg_connect(getenv("DATABASE_URL"));

function getPass(){
    $id = $_SESSION['loggedUser']['Id'];
    global $mysql;
    $result =  pq_query($mysql,"SELECT Pass FROM client WHERE Id = $id;");
    while(($row = $result->fetch_assoc()) != false){
        return $row['Pass'];
    }
    return false;
}

$user = $_SESSION["loggedUser"]["Id"];
$lastPass =  $_POST['lastPass'];
$newPass = md5($_POST['newPass']);
$confirm = getPass();

if(md5($lastPass) != $confirm){
    echo "confirmError";
}else{
    pq_query($mysql,"UPDATE client SET Pass = '$newPass' WHERE Id = $user");
}

