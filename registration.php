<?php
$mysql = pg_connect(getenv("DATABASE_URL"));
    $results = pg_fetch_all(pg_query($mysql,"SELECT * FROM client;"));
    $user = false;
    foreach ($results as $result){
        print_r($result);
        echo '|||||||||||||';
        if($result['Mail'] == $email && $result['Pass'] == "$pass"){
            $user = true;
        }
    }
?>
