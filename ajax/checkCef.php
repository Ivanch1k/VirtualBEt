<?php
session_start();
$mysql = pg_connect(getenv("DATABASE_URL"));

$matchesStorage = $_POST['matches'];
foreach ($matchesStorage as $matchStorage){
    $id = $matchStorage[4];
    $event = $matchStorage[2];
    $cef = $matchStorage[3];
    $matches = pq_query($mysql,"SELECT * FROM match1 WHERE Id = $id");
    foreach ($matches as $match){
        $mCef = round($match[$event],2);
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
