$mysql = pg_connect(getenv("DATABASE_URL"));
    $results = pg_fetch_all(pq_query($mysql,"SELECT * FROM client;"));
    $user = false;
    foreach ($results as $result){
        echo($result);
        if($result['Mail'] == $email && $result['Pass'] == "$pass"){
            $user = true;
        }
    }
