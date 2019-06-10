<?php
session_start();

$mysql = pg_connect(getenv("DATABASE_URL"));
$id = $_SESSION['loggedUser']['Id'];

$balance = pq_query($mysql,"SELECT Balance From client WHERE Id = $id;");

foreach ($balance as $b){
    $_SESSION['loggedUser']['Balance'] = $b['Balance'];
    $balik = $b['Balance'];
    echo $balik;
}