<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="google-signin-client_id" content="297215942002-p5rsdkjl4m9hqle139jqmqnpv78kf627.apps.googleusercontent.com">
    <title>VirtualBet</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/settings.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/button.css">
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/mainPage.css">
    <link rel="stylesheet" href="css/match.css">
    <link rel="stylesheet" href="css/live.css">
    <link rel="stylesheet" href="css/coupon.css">
    <link rel="stylesheet" href="css/logIn.css">
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
                        <a class="headerBtn" id="liveBtn">Live</a>
                    </li>

                </ul>
            </div>
        </div>
        <div id="headDiv">
            <button class="btn-come-in" id="authorizeBtn">Войти</button>
            <button class="btn-regestration" id="regBtn">Регистрация</button>
        </div>
    </div>



    <div id="myModalAuto" class="modal">
        <div class="modal-content">
            <div class="modal-header1">
                <h2 class="modal-text">Авторизация</h2>
                <span id="closeAuto" class="close">&times;</span>
            </div>
            <div class="modal-body1">
                <div class="div1" id="authorization">
                    <form>
                        <input id="autoEmail" class="formReg" type="email" name="email" placeholder="email"></br>
                        <input id="autoPass" class="formReg" type="password" name="regPass" placeholder="пароль"></br>
                    </form>
                    <div id="autoErrorMes" class="errorMes"></div>
                    <div class="forget-password">
                    <button type="button" id="RecPassBtn" class="RecPassBtn" >Забыли пароль?</button>
                    <div class="g-signin2" data-onsuccess="onSignIn"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer1">
                <button type="button" id="sendAutoBtn" class="btn-regestration">Войти</button>
            </div>
        </div>

    </div>
    <!-- Востановление пароля-->
    <div id="myModalRec" class="modal">
        <div class="modal-content">
            <div class="modal-header1">
                <h2 class="modal-text">Востановление пароля</h2>
                <span id="closeRec" class="close">&times;</span>
            </div>
            <div class="modal-body1">
                <div class="div1" id="recPasswordDic">
                    <form>
                        <input id="recEmail" class="formReg" type="email" name="email" placeholder="email"></br>
                    </form>
                    <div id="recErrorMes" class="errorMes"></div>
                </div>
            </div>
            <div class="modal-footer1">
                <button type="button" id="sendRecBtn" class="btn-regestration">Отправить</button>
            </div>
        </div>

    </div>



    <div id="myModalReg" class="modal">
        <div class="modal-content">
            <div class="modal-header1">
                <h2 class="modal-text">Регистрация</h2>
                <span id="closeReg" class="close">&times;</span>
            </div>
            <div class="modal-body1">
                <div class="div1" id="registration">
                    <form>
                        <input id="regEmail" class="formReg" type="email" name="email" placeholder="email*"></br>
                        <input id="regName" class="formReg" type="text" name="name" placeholder="имя*"></br>
                        <input id="regSecondName" class="formReg" type="text" name="secondName"
                               placeholder="фамилия*"></br>
                        <input id="regDate" class="formReg" type="date" name="date"></br>
                        <input id="regPass" class="formReg" type="password" name="regPass" placeholder="пароль*"></br>
                        <input id="regConfPass" class="formReg" type="password" name="regConfPass"
                               placeholder="подтверждение пароля*"></br>
                        <div class="input-phone1"><input maxlength="9" id="numberInp" class="input-place-phone1"
                                                        type="text" name="number" placeholder="номер телефона*"><span
                                    class="text-input-phone1">+380 </span></div>
                    </form>
                    <div class="errorMes" id="regErrorMes"></div>
                </div>
            </div>
            <div class="modal-footer1">
                <button type="button" id="sendBtn" class="btn-regestration">Регистрация</button>
            </div>
        </div>

    </div>

</header>


<script>
    const modal = document.getElementById("myModalReg");

    const span = document.getElementById("closeReg");


    span.onclick = () => {
        modal.style.display = "none";
    };

    window.onclick = (event) => {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    };

    const modalAuto = document.getElementById("myModalAuto");

    const spanAuto = document.getElementById("closeAuto");


    spanAuto.onclick = () => {
        modalAuto.style.display = "none";
    };

    window.onclick = (event) => {
        if (event.target === modalAuto) {
            modalAuto.style.display = "none";
        }
    };

    const modalRec = document.getElementById("myModalRec");

    const spanRec = document.getElementById("closeRec");


    spanRec.onclick = () => {
        modalRec.style.display = "none";
    };

    window.onclick = (event) => {
        if (event.target === modalRec) {
            modalRec.style.display = "none";
        }
    }
</script>
<script src="https://apis.google.com/js/platform.js" async defer></script>
<script src = "javaScript/doGoogle.js"></script>