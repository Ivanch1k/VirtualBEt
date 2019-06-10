<?php
require 'phpQuery-onefile.php';
$mysql = pg_connect(getenv("DATABASE_URL"));

function ChangeLiveCef($matchId, $event, $val)
{

    //определение переменных
    global $mysql;
    $marga = 0.05;
    $matchCefs = pq_query($mysql,"SELECT * FROM match1 WHERE Id = $matchId;");

    if($event == 'P1' || $event == 'P2' || $event == 'Px'){
        $fond = pq_query($mysql,"SELECT SUM(Money) FROM coupon WHERE Id IN(SELECT CouponId FROM bet WHERE MatchId = $matchId AND Event IN('P1','P2','Px'));");
        foreach ($fond as $f){
            $bank = $f['SUM(Money)'];
        }
        foreach ($matchCefs as $cefs){
            $firstCef = $cefs['P1'];
            $secondCef = $cefs['P2'];
            $draw = $cefs['Px'];
        }
        $t1 = pq_query($mysql,"SELECT SUM(Money) FROM coupon WHERE Id IN(SELECT CouponId FROM bet WHERE MatchId = $matchId AND Event = 'P1');");
        $t2 = pq_query($mysql,"SELECT SUM(Money) FROM coupon WHERE Id IN(SELECT CouponId FROM bet WHERE MatchId = $matchId AND Event = 'P2');");
        $tx = pq_query($mysql,"SELECT SUM(Money) FROM coupon WHERE Id IN(SELECT CouponId FROM bet WHERE MatchId = $matchId AND Event = 'Px');");
    }else{
        $fond = pq_query($mysql,"SELECT SUM(Money) FROM coupon WHERE Id IN(SELECT CouponId FROM bet WHERE MatchId = $matchId AND Event IN('P1x','P2x','P12'));");
        foreach ($fond as $f){
            $bank = $f['SUM(Money)'];
        }
        foreach ($matchCefs as $cefs){
            $firstCef = $cefs['P1x'];
            $secondCef = $cefs['P2x'];
            $draw = $cefs['P12'];
        }
        $t1 = pq_query($mysql,"SELECT SUM(Money) FROM coupon WHERE Id IN(SELECT CouponId FROM bet WHERE MatchId = $matchId AND Event = 'P1x');");
        $t2 = pq_query($mysql,"SELECT SUM(Money) FROM coupon WHERE Id IN(SELECT CouponId FROM bet WHERE MatchId = $matchId AND Event = 'P2x');");
        $tx = pq_query($mysql,"SELECT SUM(Money) FROM coupon WHERE Id IN(SELECT CouponId FROM bet WHERE MatchId = $matchId AND Event = 'P12');");
    }
    foreach ($t1 as $t){
        $total1 = $t['SUM(Money)'];
    }
    foreach ($t2 as $t){
        $total2 = $t['SUM(Money)'];
    }
    foreach ($tx as $t){
        $totalDraw = $t['SUM(Money)'];
    }
    $value = 1000000;

    $bank += 1000000;
    $bank += $val;


    $total1 += ($value - ($value * marga)) / $firstCef;
    $total2 += ($value - ($value * marga)) / $secondCef;
    $totalDraw += ($value - ($value * marga)) / $draw;

    if($event == 'P1'|| $event == 'P1x'){
        $total1 += $val;
    }else if($event == 'P2' || $event == 'P2x'){
        $total2 += $val;
    }else if($event == 'Px' || $event == 'P12'){
        $totalDraw += $val;
    }

    $max = $bank - $bank * $marga;

    if($event == 'P1'|| $event == 'P1x'){
        $newCef = $max/$total1;
        if($newCef < 1.001){
            $newCef = 1.001;
        }
        $ostatok = $firstCef - $newCef;
        $firstCef = $newCef;
        $max = $bank - $bank * $marga;
        $newSecond_kef = $ostatok / ((($max - ($draw * $totalDraw)) /($max - ($secondCef * $total2)))+1);
        $newDraw = $ostatok - $newSecond_kef;

        $secondCef += $newSecond_kef;
        $draw += $newDraw;
    }else if($event == 'P2'|| $event == 'P2x'){
        $newCef = $max / $total2;
        if($newCef < 1.001){
            $newCef = 1.001;
        }
        $ostatok = $secondCef - $newCef;
        $secondCef = $newCef;
        $max = $bank - $bank * $marga;
        $newFirst_kef = $ostatok / ((($max - ($draw * $totalDraw )) /($max - ($firstCef * $total1)))+1);
        $newDraw = $ostatok - $newFirst_kef;

        $firstCef += $newFirst_kef;
        $draw += $newDraw;
    }else if($event == 'Px'|| $event == 'P12'){
        $newCef = $max / $totalDraw;
        if($newCef < 1.001){
            $newCef = 1.001;
        }
        $ostatok = $draw - $newCef;
        $draw = $newCef;
        $max = $bank - $bank * $marga;
        $newFirst_kef = $ostatok / ((($max - ($secondCef * $total2)) /($max - ($firstCef * $total1 )))+1);
        $newSecond_kef = $ostatok - $newFirst_kef;

        $firstCef += $newFirst_kef;
        $secondCef += $newSecond_kef;
    }

    if($event == 'P1' || $event == 'P2' || $event == 'Px'){
        pq_query($mysql,"UPDATE match1 SET P1 = $firstCef, P2 = $secondCef, Px = $draw WHERE Id = $matchId");
    }else{
        pq_query($mysql,"UPDATE match1 SET P1x = $firstCef, P2x = $secondCef, P12 = $draw WHERE Id = $matchId");
    }
}

function ChangeTotalCef($matchId, $score){
    global $mysql;
    $matchCefs = pq_query($mysql,"SELECT * FROM match1 WHERE Id = $matchId;");
    foreach ($matchCefs as $matchCef){
        $tb15 = $matchCef['TB15'];
        $tb25 = $matchCef['TB25'];
        $tb35 = $matchCef['TB35'];
        $tm15 = $matchCef['TM15'];
        $tm25 = $matchCef['TM25'];
        $tm35 = $matchCef['TM35'];
    }

    switch($score){
        case 1 :
            $tb15 /= 1.5;
            $tm15 *= 1.5;
            $tb25 /= 1.5;
            $tm25 *= 1.5;
            $tb35 /= 1.5;
            $tm35 *= 1.5;
            break;
        case 2:
            $tb15 = 1;
            $tm15 = 1;
            $tb25 /= 1.5;
            $tm25 *= 1.5;
            $tb35 /= 1.5;
            $tm35 *= 1.5;
            break;
        case 3:
            $tb15 = 1;
            $tm15 = 1;
            $tb25 = 1;
            $tm25 = 1;
            $tb35 /= 1.5;
            $tm35 *= 1.5;
            break;
        case $score > 3:
            $tb15 = 1;
            $tm15 = 1;
            $tb25 = 1;
            $tm25 = 1;
            $tb35 = 1;
            $tm35 = 1;
    }

    if($tb15 < 1){$tb15 = 1;}
    if($tb25 < 1){$tb25 = 1;}
    if($tb35 < 1){$tb35 = 1;}
    if($tm15 < 1){$tm15 = 1;}
    if($tm25 < 1){$tm25 = 1;}
    if($tm35 < 1){$tm35 = 1;}

    pq_query($mysql,"UPDATE match1 SET TB15 = $tb15, TB25 = $tb25, TB35 = $tb35, TM15 = $tm15, TM25 = $tm25, TM35 = $tm35 WHERE Id = $matchId");
}

////////////Парсинг
$matches = pq_query($mysql,"SELECT * FROM match1 WHERE Stat < 2");
$url ='https://777score.ua/';
$file = file_get_contents($url);
$doc = phpQuery::newDocument($file);

foreach ($doc->find(".main-table div ul .item .row .match-link") as $championship){
    $championship = pq($championship);
    $teamText = $championship->find(".competitors span:eq(0) span")->text();
    foreach ($matches as $match){
        $matchId = $match['Id'];
        if($match['Team1'] == $teamText){
            $statText = $championship->find("span:eq(1) span")->text();
            $result1 = $championship->find(".competitors span:eq(2) span:eq(0)")->text();
            $result2 = $championship->find(".competitors span:eq(2) span:eq(2)")->text();
            $result = $result1.":".$result2;

            if($statText == "Завершен"){
                pq_query($mysql,"UPDATE match1 SET Stat = 2, Result ='$result', TB15 = 1, TB25 = 1, TB35 = 1, TM15 = 1, TM25 = 1, TM35 = 1, P1 = 1, P2 = 1, Px = 1,P1x = 1, P2x = 1, P12 = 1 WHERE Id = $matchId");
            }else if ($statText != ""){
                $sqlResult = $match['Result'];
                if($sqlResult == null){
                    $sqlResult = "0:0";
                }
                $resArray = explode(":",$sqlResult);

                $sqlSum = $resArray[0] + $resArray[1];
                $sqlDifference = $resArray[0] - $resArray[1];
                $parseSum = $result1 + $result2;
                $parseDifference = $result1 - $result2;

                // изменение кэфов
                if($sqlDifference != $parseDifference){
                    if(abs($parseDifference) < abs($sqlDifference)){
                        if($parseDifference > $sqlDifference){
                            ChangeLiveCef($matchId,"Px",15000);
                            ChangeLiveCef($matchId,"P1",12000);
                            ChangeLiveCef($matchId,"P1x",10000);
                            ChangeLiveCef($matchId,"P12",10000);
                        }else{
                            ChangeLiveCef($matchId,"Px",15000);
                            ChangeLiveCef($matchId,"P2",12000);
                            ChangeLiveCef($matchId,"P2x",15000);
                            ChangeLiveCef($matchId,"P12",12000);
                        }
                    }else{
                        if($parseDifference > $sqlDifference){
                            ChangeLiveCef($matchId,"P1",20000);
                            ChangeLiveCef($matchId,"P1x",20000);
                        }else{
                            ChangeLiveCef($matchId,"P2",20000);
                            ChangeLiveCef($matchId,"P2x",20000);
                        }
                    }
                }

                if($sqlSum != $parseSum){
                    ChangeTotalCef($matchId,$parseSum);
                }

                pq_query($mysql,"UPDATE match1 SET Stat = 1, Result ='$result'WHERE Id = $matchId");
            }

        }
    }
}