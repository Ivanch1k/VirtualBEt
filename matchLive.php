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
<div class="container">
    <div data-status = "<?php echo $stat ?>" id="<?php echo $id ?>" class="matchMain">
        <div class="match-logo">
            <div class="matchImg"><img src="images/<?php echo $img1 ?>.png"></div>
            <div class="matchInfo">
                <p class="teams"><?php echo $match['Team1']; ?></p>
                <p class="teams"> <?php echo $match['Result']; ?> </p>
                <p class="teams"><?php echo $match['Team2']; ?></p>
            </div>
            <div class="matchImg"><img src="images/<?php echo $img2 ?>.png"></div>
        </div>
        <div class="match-btns">
            <div class="matchBetWin">
                <span class="match-text">1 Х 2</span></br>
                <button class="matchBtn" id="P1" value="<?php echo $match['P1'] ?>">
                    П1 <?php echo $match['P1'] ?></button>
                <button class="matchBtn" id="Px" value="<?php echo $match['Px'] ?>">
                    X <?php echo $match['Px'] ?></button>
                <button class="matchBtn" id="P2" value="<?php echo $match['P2'] ?>">
                    П2 <?php echo $match['P2'] ?></button>
            </div>
            <div class="matchBetWin">
                <span class="match-text">Двойной шанс</span></br>
                <button class="matchBtn" id="P1x" value="<?php echo $match['P1x'] ?>">
                    1X <?php echo $match['P1x'] ?></button>
                <button class="matchBtn" id="P12" value="<?php echo $match['P12'] ?>">
                    12 <?php echo $match['P12'] ?></button>
                <button class="matchBtn" id="P2x" value="<?php echo $match['P2x'] ?>">
                    2X <?php echo $match['P2x'] ?></button>
            </div>
            <div class="matchBetTotal">
                <span class="match-text">Тотал</span></br>
                <button class="matchBtn" id="TB15" value="<?php echo $match['TB15'] ?>">1.5
                    Б <?php echo $match['TB15'] ?></button>
                <button class="matchBtn" id="TM15" value="<?php echo $match['TM15'] ?>">1.5
                    М <?php echo $match['TM15'] ?></button>
                </br>
                <button class="matchBtn" id="TB25" value="<?php echo $match['TB25'] ?>">2.5
                    Б <?php echo $match['TB25'] ?></button>
                <button class="matchBtn" id="TM25" value="<?php echo $match['TM25'] ?>">2.5
                    М <?php echo $match['TM25'] ?></button>
                </br>
                <button class="matchBtn" id="TB35" value="<?php echo $match['TB35'] ?>">3.5
                    Б <?php echo $match['TB35'] ?></button>
                <button class="matchBtn" id="TM35" value="<?php echo $match['TM35'] ?>">3.5
                    М <?php echo $match['TM35'] ?></button>
            </div>
        </div>
    </div>
</div>

<?php
require "footer.php";
?>
