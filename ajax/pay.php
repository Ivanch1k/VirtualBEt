<?php
session_start();

$mysql = new mysqli("localhost","root","","virtualbet");
if ($mysql->connect_errno) {
    printf("Не удалось подключиться: %s\n", $mysql->connect_error);
    exit();
}
$mysql->query("SET NAMES 'utf-8");
$id = $_SESSION['loggedUser']['Id'];

$balance = $mysql->query("SELECT Balance From client WHERE Id = $id;");

foreach ($balance as $b){
    $_SESSION['loggedUser']['Balance'] = $b['Balance'];
    $balik = $b['Balance'];
    echo $balik;
}