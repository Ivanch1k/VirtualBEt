<?php
session_start();

$mysql = pg_connect(getenv("DATABASE_URL"));

function getMatch( $id){
    global $mysql;
    $match = pq_query($mysql,"SELECT * FROM match1 WHERE Id = '$id'");
    foreach ($match as $single){
        return $single;
    }
}

function getChamp($champ){
    switch ($champ) {
        case "WorldTov":
            $champ = "Мирм";
            break;
        case "WorldClub" :
            $champ = "Мирк";
            break;
        case "England" :
            $champ = "Англия";
            break;
        case "Germany" :
            $champ = "Германия";
            break;
        case "Spain" :
            $champ = "Испания";
            break;
        case "Italy" :
            $champ = "Италия";
            break;
        case "France" :
            $champ = "Франция";
            break;
    }
    return $champ;
}
?>