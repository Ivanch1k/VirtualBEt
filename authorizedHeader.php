<?php require 'getMoney.php';
$id = $_SESSION["loggedUser"]["Id"];
$name = $_SESSION["loggedUser"]["Name"];
$secondName = $_SESSION["loggedUser"]["SecondName"];
$owner = "$name $secondName";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>VirtualBet</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/autorizedHead.css">
    <link rel="stylesheet" href="css/button.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/mainPage.css">
    <link rel="stylesheet" href="css/match.css">
    <link rel="stylesheet" href="css/history.css">
    <link rel="stylesheet" href="css/live.css">
    <link rel="stylesheet" href="css/coupon.css">
    <link rel="stylesheet" href="css/settings.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/all.css" integrity="sha384-i1LQnF23gykqWXg6jxC2ZbCbUMxyw5gLZY6UiUS98LYV5unm8GWmfkIS6jqJfb4E" crossorigin="anonymous">
</head>
<body>
<header class="header">
    <div class="container head">
        <div class="head-main-btn">
            <img src="images/stavki.png" class="img-logo" width="250" height="150">
            <div class="main-btn">
                <ul class="btn-list">
                    <li class="btn-item">
                        <a class="headerBtn" id="mainBtn">Сетка</a>
                    </li>
                    <li class="btn-item">
                        <a class="headerBtn" id="liveBtn" style="border: 1px solid #EA0C68; background-color: #EA0C68;">Live</a>
                    </li>
                    <li class="btn-item">
                        <a id="valutaBtn" class="headerBtn" style="font-weight: bold; font-size: 25px">Валюта</a>
                    </li>
                </ul>
            </div>
        </div>
        <div id="headDiv" class="headDiv">
            <div class="poster">
                <div class="balance">
                    <div class="balance-text">
                        <span style="white-space: nowrap;">Баланс: <span id="clientsBalance"><?php echo round($_SESSION['loggedUser']['Balance'],2) ?></span><i
                                    class="fas fa-dollar-sign"></i><i class="fas fa-sync" id="refreshBtn" style="padding-left: 12px"></i>
                    </div>
                    <div class="balance-bill">
                    <span style="white-space: nowrap;">№счёта: <?php echo $_SESSION['loggedUser']['Id'] ?></span>
                    <svg width="33" height="16" viewBox="0 0 33 16" xmlns="http://www.w3.org/2000/svg"><g fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M23 5l5 5 5-5H23z" fill="#EAECF1"></path><path d="M7.974 8.48c2.364 0 4.282-1.901 4.282-4.246C12.256 1.889 10.338 0 7.974 0 5.609 0 3.69 1.902 3.69 4.234S5.61 8.48 7.974 8.48zm0-7.373c1.734 0 3.153 1.407 3.153 3.127 0 1.72-1.42 3.126-3.153 3.126-1.734 0-3.153-1.407-3.153-3.126 0-1.72 1.419-3.127 3.153-3.127zM.565 15.111h14.87a.558.558 0 0 0 .565-.56c0-2.931-2.404-5.328-5.373-5.328H5.373C2.417 9.223 0 11.607 0 14.55c0 .313.25.56.565.56zm4.808-4.768h5.254c2.155 0 3.928 1.59 4.204 3.648H1.169c.276-2.045 2.05-3.648 4.204-3.648z" fill="#EAECF1"></path></g></svg>
                </div>
                <div class="descr">
                        <a href="history.php">
                            <button id="historyBtn" class="descr-btn"><i class="fas fa-history"></i>История</button>
                        </a>
                        <a id="settingsBtn" >
                            <button id="settingsBtn" class="descr-btn"><i class="fas fa-cog"></i>Настройки</button>
                        </a>
                        <a href="logOut.php">
                            <button id="exitBtn" class="descr-btn"><i class="fas fa-sign-out-alt"></i>Выход</button>
                        </a>
                </div>
            </div>
        </div>
    </div>
        <div id="myModalSettings" class="modal">
            <div class="modal-content">
                <div class="modal-header1">
                    <h2 class="modal-text">ЛИЧНЫЙ КАБИНЕТ</h2>
                    <span id="closeAuto" class="close">&times;</span>
                </div>
                <div class="modal-body1">
                    <div class="settings-container">
                        <div id="settingsDiv" class="settingsDiv">
                            <div class="settingsDiv-text">
                                <span class="settingsSpan" id="idSpan">Номер счёта: <?php echo $id ?></span>
                                <span class="settingsSpan" id="nameSpan">Владелец аккаунта: <?php echo $owner ?></span>
                            </div>
                            <div class="settingsDiv-btns">
                                <button id="changePasswordBtn" class="settingsBtn">Изменить пароль</button>
                                <button id="changeNumberBtn" class="settingsBtn">Изменить номер телефона</button>
                            </div>
                        </div>

                        <div class="changePasswordDiv" id="changePasswordDiv">
                            <form>
                                <div class="password-input"><span
                                            style="color: #5378af;font-size: 13px;font-weight: 600;text-transform: uppercase;">Старый пароль:&#8194;</span>
                                    <input id="lastPassImp" class="formReg" type="password" name="lastPass"></div>
                                <div class="password-input"><span
                                            style="color: #5378af;font-size: 13px;font-weight: 600;text-transform: uppercase;">Новый пароль:&#8194;</span><input
                                            id="newPassImp" class="formReg" type="password" name="newPass"></div>
                                <div class="password-input"><span
                                            style="color: #5378af;font-size: 13px;font-weight: 600;text-transform: uppercase;">Подтвердите пароль:&#8194;</span><input
                                            id="confPassImp" class="formReg" type="password" name="confPass"></div>
                                <button type="button" id="confirmPasswordBtn" class="confirmPasswordBtn btn-regestration">Подтвердить</button>
                            </form>
                            <div class="errorMes" id="passErrorMes"></div>
                        </div>

                        <div class="changeNumberDiv" id="changeNumberDiv">
                            <form>

                                <div class="input-phone"><input maxlength="9" id="numberInp" class="formReg input-place-phone"
                                                                type="text" name="number" placeholder="номер телефона"><span
                                            class="text-input-phone">+380 </span></div>
                                <div class="line-break"></div>
                                <button type="button" id="confirmNumberBtn" class="confirmNumberBtn btn-regestration">Подтвердить</button>
                            </form>
                            <div class="errorMes" id="numberErrorMes"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer1">

                </div>
            </div>
</header>
<script>
    const a = document.getElementById('myModalSettings')
    const b = document.getElementById('settingsBtn')
    const close = document.getElementById('closeAuto')
    const changePasswordDiv = document.getElementById('changePasswordDiv');
    const changeNumberDiv = document.getElementById('changeNumberDiv');
    b.onclick  = () => {a.style.display='block'}
    close.onclick = () => {
        a.style.display = 'none';
        changeNumberDiv.style.display = 'none';
        changePasswordDiv.style.display = 'none';
    }
</script>



<?php
require "footer.php";
?>
