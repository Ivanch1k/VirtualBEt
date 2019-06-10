<?php
session_start();

$mysql = pg_connect(getenv("DATABASE_URL"));
$id = $_SESSION['loggedUser']['Id'];

$balances = pq_query($mysql,"SELECT Balance From client WHERE Id = $id;");

foreach ($balances as $balance){
    $balik = $balance['Balance'];
    if($balik < 100){
        $balik += 30;
        pq_query($mysql,"UPDATE client SET Balance = $balik WHERE Id = $id;");
        $_SESSION['loggedUser']['Balance'] = $balik;
    }else{
        echo "Error";
    }
}