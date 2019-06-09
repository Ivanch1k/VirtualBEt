<?php
session_start();

$mysql = new mysqli("localhost","root","","virtualbet");
if ($mysql->connect_errno) {
    printf("Не удалось подключиться: %s\n", $mysql->connect_error);
    exit();
}
$mysql->query("SET NAMES 'utf-8");

function getValuta(){
    $id = $_SESSION['loggedUser']['Id'];
    global $mysql;
    $result = $mysql->query("SELECT Balance FROM client WHERE Id = $id;");
    while(($row = $result->fetch_assoc()) != false){
            return $row['Balance'];
    }
    return false;
}

function getLastId(){
    global $mysql;
    $result = $mysql->query("SELECT MAX(Id) FROM coupon;");
    while(($row = $result->fetch_assoc()) != false){
        $res = $row['MAX(Id)'];
        return ++$res;
    }
    return false;
}

//функция изменения кеэфов
function ChangeCef($matchId, $event)
{

    //определение переменных
    global $mysql;
    $marga = 0.05;
    $matchCefs = $mysql->query("SELECT * FROM match1 WHERE Id = $matchId;");

    if($event == 'P1' || $event == 'P2' || $event == 'Px'){
        $fond = $mysql->query("SELECT SUM(Money) FROM coupon WHERE Id IN(SELECT CouponId FROM bet WHERE MatchId = $matchId AND Event IN('P1','P2','Px'));");
        foreach ($fond as $f){
            $bank = $f['SUM(Money)'];
        }
        foreach ($matchCefs as $cefs){
            $firstCef = $cefs['P1'];
            $secondCef = $cefs['P2'];
            $draw = $cefs['Px'];
        }
        $t1 = $mysql->query("SELECT SUM(Money) FROM coupon WHERE Id IN(SELECT CouponId FROM bet WHERE MatchId = $matchId AND Event = 'P1');");
        $t2 = $mysql->query("SELECT SUM(Money) FROM coupon WHERE Id IN(SELECT CouponId FROM bet WHERE MatchId = $matchId AND Event = 'P2');");
        $tx = $mysql->query("SELECT SUM(Money) FROM coupon WHERE Id IN(SELECT CouponId FROM bet WHERE MatchId = $matchId AND Event = 'Px');");
    }else{
        $fond = $mysql->query("SELECT SUM(Money) FROM coupon WHERE Id IN(SELECT CouponId FROM bet WHERE MatchId = $matchId AND Event IN('P1x','P2x','P12'));");
        foreach ($fond as $f){
            $bank = $f['SUM(Money)'];
        }
        foreach ($matchCefs as $cefs){
            $firstCef = $cefs['P1x'];
            $secondCef = $cefs['P2x'];
            $draw = $cefs['P12'];
        }
        $t1 = $mysql->query("SELECT SUM(Money) FROM coupon WHERE Id IN(SELECT CouponId FROM bet WHERE MatchId = $matchId AND Event = 'P1x');");
        $t2 = $mysql->query("SELECT SUM(Money) FROM coupon WHERE Id IN(SELECT CouponId FROM bet WHERE MatchId = $matchId AND Event = 'P2x');");
        $tx = $mysql->query("SELECT SUM(Money) FROM coupon WHERE Id IN(SELECT CouponId FROM bet WHERE MatchId = $matchId AND Event = 'P12');");
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
    $value = 100000;

    $bank += 100000;
    $total1 += ($value - ($value * marga)) / $firstCef; // тотал выставляется как 100_000 - (100_000 * маржа) + результат запроса
    $total2 += ($value - ($value * marga)) / $secondCef;
    $totalDraw += ($value - ($value * marga)) / $draw;

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
        $mysql->query("UPDATE match1 SET P1 = $firstCef, P2 = $secondCef, Px = $draw WHERE Id = $matchId");
    }else{
        $mysql->query("UPDATE match1 SET P1x = $firstCef, P2x = $secondCef, P12 = $draw WHERE Id = $matchId");
    }
}


//проверка кэфов
$counter = 0;
$matchesStorage = $_POST['matches'];
foreach ($matchesStorage as $matchStorage){
    $id = $matchStorage[4];
    $event = $matchStorage[2];
    $cef = $matchStorage[3];
    $matches = $mysql->query("SELECT * FROM match1 WHERE Id = $id");
    foreach ($matches as $match){
        $mCef = $match[$event];
        if($mCef != $cef){
            $counter++;
        }
    }
}

if($counter < 1){
    $sum = $_POST['sum'];
    $matches = $_POST['matches'];
    $cef = $_POST['cef'];
    $lastId = getLastId();
    $date = date('Y-m-d G:i:s', strtotime("+1 hours"));

    if(!(isset($_SESSION['loggedUser']))){
        echo 'notAuthorizeError';
    }else if($sum > getValuta()){
        $a = getValuta();
        echo 'littleValutaError';
    }else{
        $clientId = $_SESSION["loggedUser"]["Id"];
        $balance = getValuta();
        $balance -= $sum;
        $mysql->query("UPDATE client SET Balance = $balance WHERE Id = $clientId");
        $_SESSION["loggedUser"]["Balance"] = $balance;
        $mysql->query("INSERT INTO coupon(Id,ClientId,Stat,DateAndTime,Money,Coefficient) VALUES($lastId,$clientId,0,'$date',$sum,$cef);");
        foreach($matches as $match){
            $matchId = $match[4];
            $coefficient = $match[3];
            $event = $match[2];
            $mysql->query("INSERT INTO bet(CouponId,MatchId,Stat,Coefficient,Event) VALUES($lastId,$matchId,0,$coefficient,'$event');");
            if($event == 'P1' || $event == 'P2' || $event == 'Px' || $event == 'P1x' || $event == 'P2x' || $event == 'P12'){
                ChangeCef($matchId, $event);
            }
        }
    }
}else{
    echo "wrongCef";
}

?>