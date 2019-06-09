<?php
session_start();

$link = pg_connect(getenv("DATABASE_URL"));

if (!$link) {
printf("Не удалось подключиться: %s\n");
exit();
}
$response = pg_query($link, $sql);
$mysql->query("SET NAMES 'utf-8");

function getMatch( $id){
    global $mysql;
    $match = pg_query($link, "SELECT * FROM match1 WHERE Id = '$id'");
    foreach ($match as $single){
        return $single;
    }
}

function getChamp($champ){
    switch ($champ) {
        case "WorldTov":
            $champ = "Мир международные";
            break;
        case "WorldClub" :
            $champ = "Мир клубные";
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
