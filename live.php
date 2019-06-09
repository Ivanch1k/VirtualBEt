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
        $matches = $mysql->query("SELECT * FROM match1 WHERE Championship = '$champ' AND Stat = 1");
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
                            href="http://localhost/dashboard/virtualBet/Live.php?champ=WorldTov">МИР:
                        Международные товарищеские матчи</a>
                </li>
                <li class="champLi" id="champWorldClub">
                    <img src="https://lipis.github.io/flag-icon-css/flags/4x3/cy.svg" class="flag" width="23px"><a
                            style="text-decoration: none" class="champ-href"
                            href="http://localhost/dashboard/virtualBet/Live.php?champ=WorldClub">МИР:
                        Клубные товарищеские матчи</a>
                </li>
                <li class="champLi" id="champEngland">
                    <img src="https://lipis.github.io/flag-icon-css/flags/4x3/gb.svg" class="flag" width="23px"><a
                            style="text-decoration: none" class="champ-href"
                            href="http://localhost/dashboard/virtualBet/Live.php?champ=England">АНГЛИЯ:
                        Премьер-лига</a>
                </li>
                <li class="champLi" id="champGermany">
                    <img src="https://lipis.github.io/flag-icon-css/flags/4x3/de.svg" class="flag" width="23px"><a
                            style="text-decoration: none" class="champ-href"
                            href="http://localhost/dashboard/virtualBet/Live.php?champ=Germany">ГЕРМАНИЯ:
                        Бундеслига</a>
                </li>

                <li class="champLi" id="champSpain">
                    <img src="https://lipis.github.io/flag-icon-css/flags/4x3/es.svg" class="flag" width="23px"><a
                            style="text-decoration: none" class="champ-href"
                            href="http://localhost/dashboard/virtualBet/Live.php?champ=Spain">ИСПАНИЯ:
                        Примера</a>
                </li>
                <li class="champLi" id="champItaly">
                    <img src="https://lipis.github.io/flag-icon-css/flags/4x3/it.svg" class="flag" width="23px"><a
                            style="text-decoration: none" class="champ-href"
                            href="http://localhost/dashboard/virtualBet/Live.php?champ=Italy">ИТАЛИЯ:
                        Серия А</a>
                </li>

                <li class="champLi" id="champFrance">
                    <img src="https://lipis.github.io/flag-icon-css/flags/4x3/mq.svg" class="flag" width="23px"><a
                            style="text-decoration: none" class="champ-href"
                            href="http://localhost/dashboard/virtualBet/Live.php?champ=France">ФРАНЦИЯ:
                        Первая лига</a>
                </li>
            </ul>
        </div>

        <div id="matchesDiv" class="main-match">
            <?php
            if ($champ != false):
                foreach ($matches as $match):
                    ?>
                    <div class="matchDivLive" id="<?php echo $match['Id'] ?>">
                        <a class="match-href" style="text-decoration: none">
                            <p><?php echo $match['Team1']?></p>
                            <p><?php echo $match['Result']?></p>
                            <p><?php echo $match['Team2']?></p>
                            <!-- МАКС ДОБАВЬ ТУТ КРАСНУ ТОЧКУ СПРАВА(ТИПО ЛАЙВ) -->
                        </a>
                    </div>
                <?php endforeach;
            else:
//            echo "Выберте чемпионат";
            endif;
            ?>
        </div>
        <div class="sidebar">
            <img src="https://via.placeholder.com/280x300">
        </div>
    </div>
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(function () {
        //ТУТ ЧИСТЫЙ КАСТЫЛЬ ЗАВЯЗАНЫЙ НА СТИЛЯХ ЛУЧШЕ ПОКА НЕ ТРОГАЙ РЕКЛАМНЫЙ БЛОК!!!
        const $window = $(window);
        const $sidebar = $(".sidebar");
        const $sidebarTop = $sidebar.position().top;
        const $sidebarHeight = $sidebar.height();
        const $footer = $('.footer');
        const $footerTop = $footer.position().top;
        const cont = document.getElementById('cont')
        const div = document.createElement('div');
        div.className = "lul"

        $window.scroll(function (event) {
            cont.appendChild(div);
            $sidebar.addClass("fixed");
            let $scrollTop = $window.scrollTop();
            let $topPosition = Math.max(0, $sidebarTop - $scrollTop);

            if ($scrollTop + $sidebarHeight > $footerTop) {
                let $topPosition = Math.min($topPosition, $footerTop - $scrollTop - $sidebarHeight);
            }

            $sidebar.css("top", $topPosition);
        });
    });
</script>


<?php
require "footer.php";
?>
