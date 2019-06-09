<?php
session_start();
$mysql = new mysqli("localhost","root","","virtualbet");
if ($mysql->connect_errno) {
    printf("Не удалось подключиться: %s\n", $mysql->connect_error);
    exit();
}
$mysql->query("SET NAMES 'utf-8");

function setStatus($event, $result){
    if($result != null){
        $resArr = explode(":",$result);
        print_r($resArr);
        $sum = $resArr[0] + $resArr[1];
        $st = 1;
        switch ($event){
            case "P1" :
                if($resArr[0] > $resArr[1]){
                    $st = 2;
                }
                break;
            case "P2" :
                if($resArr[0] < $resArr[1]){
                    $st = 2;
                }
                break;
            case "Px" :
                if($resArr[0] == $resArr[1]){
                    $st = 2;
                }
                break;
            case "P1x" :
                if($resArr[0] >= $resArr[1]){
                    $st = 2;
                }
                break;
            case "P2x" :
                if($resArr[0] <= $resArr[1]){
                    $st = 2;
                }
                break;
            case "P12" :
                if($resArr[0] != $resArr[1]){
                    $st = 2;
                }
                break;
            case "TB15" :
                if($sum > 1.5){
                    $st = 2;
                }
                break;
            case "TB25" :
                if($sum > 2.5){
                    $st = 2;
                }
                break;
            case "TB35" :
                if($sum > 3.5){
                    $st = 2;
                }
                break;
            case "TM15" :
                if($sum < 1.5){
                    $st = 2;
                }
                break;
            case "TM25" :
                if($sum < 2.5){
                    $st = 2;
                }
                break;
            case "TM35" :
                if($sum < 3.5){
                    $st = 2;
                }
                break;
        }
    }else{
        return false;
    }
    return $st;
}

//расчёт ставок

$bets = $mysql->query("SELECT * FROM bet WHERE Stat = 0");
foreach ($bets as $bet){
    $idBet = $bet['Id'];
    $matchId = $bet['MatchId'];
    $event = $bet['Event'];
    $matches = $mysql->query("SELECT * FROM match1 WHERE Id = $matchId AND Stat = 2;");
    foreach ($matches as $match){
        $result = $match['Result'];
        $status = setStatus($event,$result);
        if($status != false){
            $mysql->query("UPDATE bet SET Stat = $status WHERE Id = $idBet;");
        }
    }
}

// расчет купона
$coupons = $mysql->query("SELECT * FROM coupon WHERE Stat = 0;");
foreach ($coupons as $coupon){
    $flag = true;
    $stat = 2;
    $couponId = $coupon['Id'];
    $bets = $mysql->query("SELECT * FROM bet WHERE CouponId = $couponId;");
    foreach ($bets as $bet){
        if($bet['Stat'] == 0){
            $flag = false;
        }
        if($bet['Stat'] == 1){
            $stat = 1;
        }
    }
    if($flag){
        if($stat == 1){
            $mysql->query("UPDATE coupon SET Stat = 1 WHERE Id = $couponId;");
        }else{
            $win = $coupon['Money'] * $coupon['Coefficient'];
            $clientId = $coupon['ClientId'];
            $mysql->query("UPDATE coupon SET Stat = 2 WHERE Id = $couponId;");
            $users = $mysql->query("SELECT Id,Balance FROM client WHERE Id = $clientId;");
            foreach ($users as $user){
                $id = $user['Id'];
                $balance = $user['Balance'];
                $balance += $win;
                $mysql->query("UPDATE client SET Balance = $balance WHERE Id = $id;");
            }
        }
    }
}
//header("Location: http://localhost/dashboard/virtualBet/admin.php");