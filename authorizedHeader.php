<?php require 'getMoney.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>VirtualBet</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/autorizedHead.css">
    <link rel="stylesheet" href="css/button.css">
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/mainPage.css">
    <link rel="stylesheet" href="css/match.css">
    <link rel="stylesheet" href="css/history.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
          integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpssK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>
<body>
<header class="header">
    <div class="container head">
        <div class="head-main-btn">
            <img src="https://via.placeholder.com/300x80" class="img-logo">
            <div class="main-btn">
                <ul class="btn-list">
                    <li class="btn-item">
                        <a class="headerBtn" id="mainBtn">Сетка</a>
                    </li>
                    <li class="btn-item">
                        <a class="headerBtn" id="liveBtn">Live</a>
                    </li>
                    <li class="btn-item">
                        <a class="headerBtn">что-то еще</a>
                    </li>
                    <li class="btn-item">
                        <a id="valutaBtn" class="headerBtn" style="font-weight: bold; font-size: 20px">Валюта</a>
                    </li>
                </ul>
            </div>
        </div>
        <div id="headDiv">
            <div class="balance">
                <span>№счёта: <?php echo $_SESSION['loggedUser']['Id'] ?></span>
                </br>
                <span>Баланс: <span id="clientsBalance"><?php echo $_SESSION['loggedUser']['Balance'] ?></span><i
                        class="fas fa-dollar-sign"></i><i class="fas fa-sync" id="refreshBtn" style="padding-left: 12px">&#x21ba</i>
            </div>
            <div class="autorized-btns">
                <a href="history.php">
                    <button id="historyBtn">История</button>
                </a>
                <a href="settings.php">
                    <button id="settingsBtn">Настройки</button>
                </a>
                <a href="logOut.php">
                    <button id="exitBtn">Выход</button>
                </a>
            </div>
        </div>
    </div>


</header>

<!--<header class="header">-->
<!--    <div class="container head">-->
<!--        <div class="head-main-btn">-->
<!--            <button class="headerBtn" id="mainBtn">Сетка</button>-->
<!--            <button class="headerBtn" id="liveBtn">Live</button>-->
<!--            <button class="headerBtn" id="valutaBtn">Валюта</button>-->
<!--        </div>-->
<!--        <div id="headDiv">-->
<!--            <span>№счёта: --><?php //echo $_SESSION['loggedUser']['Id'] ?><!--</span>-->
<!--            </br>-->
<!--            <span>Баланс: --><?php //echo $_SESSION['loggedUser']['Balance'] ?><!--</span><i class="fas fa-sync"></i>-->
<!--            <a href="history.php">-->
<!--                <button id="historyBtn">История</button>-->
<!--            </a>-->
<!--            <a href="settings.php">-->
<!--                <button id="settingsBtn">Настройки</button>-->
<!--            </a>-->
<!--            <a href="logOut.php">-->
<!--                <button id="exitBtn">Выход</button>-->
<!--            </a>-->
<!--        </div>-->
<!--    </div>-->
<!--</header>-->