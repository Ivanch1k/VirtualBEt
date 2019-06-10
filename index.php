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


//выбор матчей по чемпионату
$champ = false;
if (isset($_GET['champ'])) {
    $champ = getChamp($_GET['champ']);
    if ($champ) {
        $matches = pq_query($mysql,"SELECT * FROM match1 WHERE Championship = '$champ' AND Stat = 0");
    }
}
?>
<main class="main">
    <div class="cont" id="cont">
        <div id="champDiv" class="main-champ">
            <ul class="champ-list">
                <h2 class="champ-headline"><i class="fas fa-futbol"></i>Футбол</h2>
                <li class="champLi" id="champWorldTov">
                    <img src="https://lipis.github.io/flag-icon-css/flags/4x3/cy.svg" class="flag" width="23px"><a
                            style="text-decoration: none;" class="champ-href"
                            href="https://virtualbet.herokuapp.com/index.php?champ=WorldTov">МИР:
                        Международные товарищеские матчи</a>
                </li>
                <li class="champLi" id="champWorldClub">
                    <img src="https://lipis.github.io/flag-icon-css/flags/4x3/cy.svg" class="flag" width="23px"><a
                            style="text-decoration: none" class="champ-href"
                            href="https://virtualbet.herokuapp.com/index.php?champ=WorldClub">МИР:
                        Клубные товарищеские матчи</a>
                </li>
                <li class="champLi" id="champEngland">
                    <img src="https://lipis.github.io/flag-icon-css/flags/4x3/gb.svg" class="flag" width="23px"><a
                            style="text-decoration: none" class="champ-href"
                            href="https://virtualbet.herokuapp.com/index.php?champ=England">АНГЛИЯ:
                        Премьер-лига</a>
                </li>
                <li class="champLi" id="champGermany">
                    <img src="https://lipis.github.io/flag-icon-css/flags/4x3/de.svg" class="flag" width="23px"><a
                            style="text-decoration: none" class="champ-href"
                            href="https://virtualbet.herokuapp.com/index.php?champ=Germany">ГЕРМАНИЯ:
                        Бундеслига</a>
                </li>

                <li class="champLi" id="champSpain">
                    <img src="https://lipis.github.io/flag-icon-css/flags/4x3/es.svg" class="flag" width="23px"><a
                            style="text-decoration: none" class="champ-href"
                            href="https://virtualbet.herokuapp.com/index.php?champ=Spain">ИСПАНИЯ:
                        Примера</a>
                </li>
                <li class="champLi" id="champItaly">
                    <img src="https://lipis.github.io/flag-icon-css/flags/4x3/it.svg" class="flag" width="23px"><a
                            style="text-decoration: none" class="champ-href"
                            href="https://virtualbet.herokuapp.com/index.php?champ=Italy">ИТАЛИЯ:
                        Серия А</a>
                </li>

                <li class="champLi" id="champFrance">
                    <img src="https://lipis.github.io/flag-icon-css/flags/4x3/mq.svg" class="flag" width="23px"><a
                            style="text-decoration: none" class="champ-href"
                            href="https://virtualbet.herokuapp.com/index.php?champ=France">ФРАНЦИЯ:
                        Первая лига</a>
                </li>
            </ul>
        </div>

        <div id="matchesDiv" class="main-match">
            <div class="text-matches">
                <p>Матчи</p>
            </div>
            <?php
            if ($champ != false):
                foreach ($matches as $match):
                    ?>
                    <div class="matchDiv" id="<?php echo $match['Id'] ?>">
                        <p class="match-date">
                            <?php
                            $date = $match['DateAndTime'];
                            $time = date("m-d H:i", strtotime($date));
                            echo $time;
                            ?>
                        </p>
                        <a class="match-href" style="text-decoration: none; color: #336FB2;">
                            <p><?php echo $match['Team1']?></p>
                            <span>&#8194;&mdash;&#8194;</span>
                            <p><?php echo $match['Team2']?></p>
                            <div class="line-break"></div>
                        </a>
                    </div>
                <?php endforeach;
            else:
//            echo "Выберте чемпионат";
            endif;
            ?>
        </div>
        <div class="sidebar">
            <a href="https://1xbetua.com/ua/"><img src="https://www.academiadetips.com/wp-content/uploads/2019/01/1xBet-Banner280x300.gif"></a>
        </div>
    </div>
</main>


<?php
require "footer.php";
?>



