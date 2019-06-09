<?php
session_start();

$mysql = new mysqli("localhost","root","","virtualbet");
if ($mysql->connect_errno) {
    printf("Не удалось подключиться: %s\n", $mysql->connect_error);
    exit();
}
$mysql->query("SET NAMES 'utf-8");

function getPass(){
    $id = $_SESSION['loggedUser']['Id'];
    global $mysql;
    $result = $mysql->query("SELECT Pass FROM client WHERE Id = $id;");
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
    $mysql->query("UPDATE client SET Pass = '$newPass' WHERE Id = $user");
}

