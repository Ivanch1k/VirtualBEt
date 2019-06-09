<?php
session_start();

$mysql = new mysqli("localhost","root","","virtualbet");
if ($mysql->connect_errno) {
    printf("Не удалось подключиться: %s\n", $mysql->connect_error);
    exit();
}
$mysql->query("SET NAMES 'utf-8");
$id = $_SESSION['loggedUser']['Id'];

$balances = $mysql->query("SELECT Balance From client WHERE Id = $id;");

foreach ($balances as $balance){
    $balik = $balance['Balance'];
    if($balik < 100){
        $balik += 30;
        $mysql->query("UPDATE client SET Balance = $balik WHERE Id = $id;");
        $_SESSION['loggedUser']['Balance'] = $balik;
    }else{
        echo "Error";
    }
}