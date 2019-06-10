<?php
require 'fun.php';
?>
<?php
if (isset($_SESSION["loggedUser"])) {
    require 'authorizedHeader.php';
} else {
    require "header.php";
}
require "bet.php";


$id = $_GET['id'];
$match = getMatch($id);
$date = $match['DateAndTime'];
$time = date("m-d H:i", strtotime($date));
$stat = $match['Stat'];
//выбор логотипа
$img1 = "undefinedLogo";
$img2 = "undefinedLogo";
?>
<div class="container" style="padding:10px; background-color: #D8E6FE; margin: 0 241px">
    <div data-status = "<?php echo $stat ?>" id="<?php echo $id ?>" class="matchMain">
<!--        ВОТ ТУТ ДОЛЖЕН БЫТЬ ЭТОТ БЛОК А ВНИЗУ УДАЛИТЬ!-->
<!--        <div class="matchInfo">-->
<!--               ТУТ ПХП!        -->
<!--        </div>-->
        <div class="match-logo">
            <div class="matchImg"><img src="images/<?php echo $img1 ?>.png"></div>
            <div class="matchInfo">
                <p class="teams"><?php echo $match['Team1']; ?> &#8194;&mdash;&#8194; <?php echo $match['Team2']; ?></p>
                <p class="dateAndTime match-date"> <?php echo $time; ?> </p>
            </div>
            <div class="matchImg"><img src="images/<?php echo $img2 ?>.png"></div>
        </div>
        <div class="match-btns">
            <span class="match-text"><i class="far fa-star"></i>1 Х 2</span>
            <div class="matchBetWin">
                <button class="matchBtn" id="P1" value="<?php echo round($match['P1'],2); ?>">
                    П1 <?php echo round($match['P1'],2) ?></button>
                <button class="matchBtn" id="Px" value="<?php echo round($match['Px'],2); ?>">
                    X <?php echo round($match['Px'],2) ?></button>
                <button class="matchBtn" id="P2" value="<?php echo round($match['P2'],2); ?>">
                    П2 <?php echo round($match['P2'],2) ?></button>
            </div>
            <span class="match-text"><i class="far fa-star"></i>Двойной шанс</span>
            <div class="matchBetWin">
                <button class="matchBtn" id="P1x" value="<?php echo round($match['P1x'],2); ?>">
                    1X <?php echo round($match['P1x'],2) ?></button>
                <button class="matchBtn" id="P12" value="<?php echo round($match['P12'],2); ?>">
                    12 <?php echo round($match['P12'],2) ?></button>
                <button class="matchBtn" id="P2x" value="<?php echo round($match['P2x'],2); ?>">
                    2X <?php echo round($match['P2x'],2) ?></button>
            </div>
            <span class="match-text"><i class="far fa-star"></i>Тотал</span>
            <div class="matchBetTotal">
                <div class="match-total-btns">
                    <button class="matchBtn" id="TB15" value="<?php echo round($match['TB15'],2) ?>">1.5
                        Б <?php echo round($match['TB15'],2) ?></button>
                    <button class="matchBtn" id="TM15" value="<?php echo round($match['TM15'],2) ?>">1.5
                        М <?php echo round($match['TM15'],2) ?></button>
                </div>
                <div class="match-total-btns">
                    <button class="matchBtn" id="TB25" value="<?php echo round($match['TB25'],2) ?>">2.5
                        Б <?php echo round($match['TB25'],2) ?></button>
                    <button class="matchBtn" id="TM25" value="<?php echo round($match['TM25'],2) ?>">2.5
                        М <?php echo round($match['TM25'],2) ?></button>
                </div>
                <div class="match-total-btns">
                    <button class="matchBtn" id="TB35" value="<?php echo round($match['TB35'],2) ?>">3.5
                        Б <?php echo round($match['TB35'],2) ?></button>
                    <button class="matchBtn" id="TM35" value="<?php echo round($match['TM35'],2) ?>">3.5
                        М <?php echo round($match['TM35'],2) ?></button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require "footer.php";
?>
