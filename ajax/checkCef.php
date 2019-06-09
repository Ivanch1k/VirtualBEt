<?php
session_start();
$mysql = new mysqli("localhost","root","","virtualbet");
if ($mysql->connect_errno) {
    printf("Не удалось подключиться: %s\n", $mysql->connect_error);
    exit();
}
$mysql->query("SET NAMES 'utf-8");

$matchesStorage = $_POST['matches'];
foreach ($matchesStorage as $matchStorage){
    $id = $matchStorage[4];
    $event = $matchStorage[2];
    $cef = $matchStorage[3];
    $matches = $mysql->query("SELECT * FROM match1 WHERE Id = $id");
    foreach ($matches as $match){
        $mCef = $match[$event];
        if($mCef != $cef){
            $rightCef[$id] = $mCef;
        }
    }
}

if($rightCef != null){
    echo json_encode($rightCef);
}else{
    echo "fail";
}
