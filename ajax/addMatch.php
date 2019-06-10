<?php
$champ = $_POST['champ'];
$team1 = $_POST['team1'];
$team2 = $_POST['team2'];
$p1 = $_POST['p1'];
$p2 = $_POST['p2'];
$px = $_POST['px'];
$p1x = $_POST['p1x'];
$p2x = $_POST['p2x'];
$p12 = $_POST['p12'];
$tb15 = $_POST['tb15'];
$tb25 = $_POST['tb25'];
$tb35 = $_POST['tb35'];
$tm15 = $_POST['tm15'];
$tm25 = $_POST['tm25'];
$tm35 = $_POST['tm35'];

$dateAndTime = $_POST['dateAndTime'];
echo "$champ $team1 $team2";

$mysql = pg_connect(getenv("DATABASE_URL"));

$res = pq_query($mysql,"INSERT INTO match1(Championship,Team1,Team2,DateAndTime,P1,P2,Px,P12,P1x,P2x,TB15,TB25,TB35,TM15,TM25,TM35) VALUES 
('$champ','$team1','$team2','$dateAndTime',$p1,$p2,$px,$p12,$p1x,$p2x,$tb15,$tb25,$tb35,$tm15,$tm25,$tm35);");

if($res){
    echo "Матч добален";
}else{
    echo "Wrong";
}
?>