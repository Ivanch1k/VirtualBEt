<?php
session_start();
require 'authorizedHeader.php';

$mysql = pg_connect(getenv("DATABASE_URL"));
///


$user = $_SESSION["loggedUser"]["Id"];
$coupons = pq_query($mysql,"SELECT * FROM coupon WHERE ClientId = $user ORDER BY DateAndTime DESC ;");

// начало вывода истории
foreach ($coupons as $coupon):
    $count = 0;
  $couponId = $coupon['Id'];
  $bets = pq_query($mysql,"SELECT * FROM bet WHERE CouponId = $couponId;");

  foreach ($bets as $bet){
      $count++;
  }

  if($count > 1){
      $type = "Експресс";
  }else{
      $type = "Ординар";
  }

?>
<div class="mainHistory">
<div class="couponDiv">
    <div class="couponDivContent">
        <span class="firstRowCoupon">№ <?php echo $coupon['Id']?></span></br>
        <span class="secondRowCoupon">от <?php echo $coupon['DateAndTime']?></span>
    </div>
    <div class="couponDivContent">
        <span class="firstRowCoupon">Тип ставки</span></br>
        <span class="secondRowCoupon"><?php echo $type?></span>
    </div>
    <div class="couponDivContent">
        <span class="firstRowCoupon">Статус</span></br>

        <?php if($coupon['Stat'] == 0): ?>
        <span class="secondRowCoupon">Не разыграна</span>
    </div>
    <div class="couponDivContent">
        <span class="firstRowCoupon">Ставка</span></br>
        <span class="secondRowCoupon"><?php echo $coupon['Money']?></span>
    </div>
    <div class="notResultCef">
        <?php echo round($coupon['Coefficient'],2)?>
    </div>

    <?php elseif($coupon['Stat'] == 1): ?>
    <span class="secondRowCoupon">Проиграна</span>
    </div>
    <div class="couponDivContent">
        <span class="firstRowCoupon">Ставка</span></br>
        <span class="secondRowCoupon"><?php echo $coupon['Money']?></span>
    </div>
    <div class="badResultCef">
        <?php echo round($coupon['Coefficient'],2)?>
    </div>

    <?php else: ?>
    <span class="secondRowCoupon">Выиграна</span>
    </div>
    <div class="couponDivContent">
        <span class="firstRowCoupon">Выигрыш</span></br>
        <span class="secondRowCoupon">
            <?php
                $win = $coupon['Money'] * $coupon['Coefficient'];
                echo $win;
            ?>
        </span>
    </div>
    <div class="goodResultCef">
        <?php echo round($coupon['Coefficient'], 2)?>
    </div>
    <?php endif; ?>
    <div data-art= "1" class="arrow">
        &#8681
    </div>
</div>

    <div class="matchesInHistory">
        <?php foreach ($bets as $bet):
            $event = $bet['Event'];
            if($event == 'ТB15'){
                $event = 'ТB 1.5';
            }
            if($event == 'ТB25'){
                $event = 'ТB 2.5';
            }
            if($event == 'ТB35'){
                $event = 'ТБ 3.5';
            }
            if($event == 'ТM15'){
                $event = 'ТМ 1.5';
            }
            if($event == 'ТM25'){
                $event = 'ТМ 2.5';
            }
            if($event == 'ТM35'){
                $event = 'ТМ 3.5';
            }
            $stat = $bet['Stat'];
            $matchId = $bet['MatchId'];
            $matches = pq_query($mysql,"SELECT * FROM match1 WHERE Id = $matchId;");
            ?>
            <div class="infoMatchHistory">
                <div class="couponDetailInfo">
                    <span>Футбол
                        <?php
                        foreach ($matches as $match){
                            $champ = $match['Championship'];
                            if($champ == 'Мирк'){
                                $champ = 'Мир клубные';
                            }
                            if($champ == 'Мирм'){
                                $champ = 'Мир международные';
                            }
                            $team1 = $match['Team1'];
                            $team2 = $match['Team2'];
                            $date  = $match['DateAndTime'];
                            $result = $match['Result'];
                            $time = date("Y-m-d H:i", strtotime($date));
                            if($result == null){
                                $result = "Не начался";
                            }
                            echo "<p>$champ</p> </br> <p>$team1-$team2</p></br> <p>Дата и время: $time</p> ";
                        }
                        ?>
                    </span>
                </div>
                <div class="couponResultInfo">
                    <span><?php echo "Результат: </br> </br> $result"?><span>
                </div>
                <div class="couponResultInfo">
                    <span><?php echo "Событие: </br></br> $event"?><span>
                </div>
                <div class="
                <?php if($stat == 0){
                    echo "notResultCef";
                }else if($stat == 1){
                    echo "badResultCef";
                }else{
                    echo "goodResultCef";
                }?>
                ">
                    <?php echo round($bet['Coefficient'],2)?>
                </div>

            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php endforeach;
?>



<?php
require "footer.php";
?>

