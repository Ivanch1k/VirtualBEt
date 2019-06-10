var matches = {};

$('document').ready(function () {
    checkBets();
    visibleBets();
});
//отображения регистрации и авторизации и востановление пароля
$("#regBtn").on( "click", function(){
       $("#registration").css("visibility","visible");
    $("#authorization").css("visibility","hidden");
    const modal = document.getElementById("myModalReg");
    modal.style.display = "block";
   }
);

$("#authorizeBtn").on( "click", function(){
        $("#authorization").css("visibility","visible");
        $("#registration").css("visibility","hidden");
    const modal = document.getElementById("myModalAuto");
    modal.style.display = "block";
    }
);

$("#RecPassBtn").on( "click", function(){
        const modal = document.getElementById("myModalRec");
        modal.style.display = "block";
    }
);

//отображение окна получения валюты
$("#valutaBtn").on( "click", function(){
        const modal = document.getElementById("myModalMoney");
        modal.style.display = "block";
    }
);

//получение валюты
$("#getMoneyBtn").on( "click", function(){
    $.ajax({
        url: 'ajax/getMoney.php',
        cache: false,
        beforeSend: function () {
            $("#getMoneyBtn").prop("disabled",true);
        },
        success:function (data) {
            if(data == 'Error'){
                $("#getMoneyErrorMes").html("<span>Виртуальная валюта выдаётся в том случае,</span><div class=\"line-break\"></div><span>если на баланс меньше 100 единиц виртуальной валюты</span>");
            }else {
                $("#videoMoney").css("visibility","visible");
                $("#videoMoney").get(0).play();
                $("#closeMoney").css("visibility","hidden");
                setTimeout(function(){ $("#closeMoney").css("visibility","visible");},13000);
            }
            $("#getMoneyBtn").prop("disabled",false);
        }
    });
    }
);
//регистраця
$("#sendBtn").on( "click", function(){
    const email = $("#regEmail").val().trim();
    const name = $("#regName").val().trim();
    const secondName = $("#regSecondName").val().trim();
    const date = $("#regDate").val().trim();
    const pass= $("#regPass").val().trim();
    const confPass = $("#regConfPass").val().trim();


    if(email == ""){
        $("#regErrorMes").text("поле email не заполнено");
        return false;
    } else if(name == ""){
        $("#regErrorMes").text("поле имя не заполнено");
        return false;
    } else if(secondName == ""){
        $("#regErrorMes").text("поле фамилия не заполнено");
        return false;
    }else if(name.length < 3){
        $("#regErrorMes").text("имя слишком короткое");
        return false;
    }
    else if(secondName.length < 3){
        $("#regErrorMes").text("фамилия слишком короткоя");
        return false;
    }else if (name.match("^[А-Яа-я]+$") == null) {
        $("#regErrorMes").text("Имя введёно некорректно");
        return false;
    }else if (secondName.match("^[А-Яа-я]+$") == null) {
        $("#regErrorMes").text("Фамилия введёна некорректно");
        return false;
    } else if(date == ""){
        $("#regErrorMes").text("дата не заполнена");
        return false;
    }else if(pass == ""){
        $("#regErrorMes").text("пароль не заполнен");
        return false;
    }else if(confPass != pass ){
        $("#regErrorMes").text("пароли не соответствуют");
        return false;
    }else if (email.match("^(([^<>()[\\]\\\\.,;:\\s@\\\"]+(\\.[^<>()[\\]\\\\.,;:\\s@\\\"]+)*)|(\\\".+\\\"))@((\\[[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\])|(([a-zA-Z\\-0-9]+\\.)+[a-zA-Z]{2,}))$") == null) {
        $("#regErrorMes").text("email введён некорректно");
        return false;
    }else if (number.match("^[0-9]{9}$") == null && number != "") {
        $("#regErrorMes").text("номер телефона введён некорректно");
        return false;
    }else if(pass.length < 6){
        $("#regErrorMes").text("пароль слишком короткий");
        return false;
        }

        //совершеннолетие
        var dateArr = date.split('-');
    var day = dateArr[2];
    var month = dateArr[1];
    var year = dateArr[0];
    var age =  18;

    var mydate = new Date();
    mydate.setFullYear(year, month-1, day);

    var currdate = new Date();
    currdate.setFullYear(currdate.getFullYear() - age);

    if(currdate < mydate)
    {
        $("#regErrorMes").text("для регистрации на сайте вы должны быть совершеннолетним");
        return false;
    }


        $.ajax({
            url: 'ajax/registration.php',
            type: 'POST',
            cache: false,
            data: {'email' : email, 'name': name, 'secondName': secondName, 'date': date, 'pass': pass, 'number':number},
            beforeSend: function () {
                $("#sendBtn").prop("disabled",true);
            },
            success:function (data) {
                if(data == 'UserExistException'){
                    $("#regErrorMes").text("Пользователь с такой почтой уже зарегистрирован на сайте");
                }else if(data == 'NumberExistException'){
                    $("#regErrorMes").text("Пользователь с такой номером телефона уже зарегистрирован на сайте");
                } else {
                    document.location.href = data;
                }
                $("#sendBtn").prop("disabled",false);
            }
        });
    }
);

// авторизация
$("#sendAutoBtn").on('click',function () {
    const email = $("#autoEmail").val().trim();
    const pass= $("#autoPass").val().trim();
    if(email == ""){
        $("#autoErrorMes").text("поле email не заполнено ");
        return false;
    }
    else if(pass == ""){
        $("#autoErrorMes").text("поле пароль не заполнено");
        return false;
    }



    $.ajax({
        url: 'ajax/authorization.php',
        type: 'POST',
        cache: false,
        data: {'email' : email, 'pass': pass},
        beforeSend: function () {
            $("#sendAutoBtn").prop("disabled",true);
        },
        success:function (data) {
            if(data == "false"){
                $("#autoErrorMes").text("Email или пароль введены неверно");
            }else{
                document.location.href = data;
            }
            $("#sendAutoBtn").prop("disabled",false);
        }
    });
});

// Востановление пароля
$("#sendRecBtn").on('click',function () {
    const email = $("#recEmail").val().trim();
    if(email == ""){
        $("#recErrorMes").text("поле email не заполнено ");
        return false;
    }



    $.ajax({
        url: 'ajax/recEmail.php',
        type: 'POST',
        cache: false,
        data: {'email' : email},
        beforeSend: function () {
            $("#sendRecBtn").prop("disabled",true);
        },
        success:function (data) {
            if(data == "false"){
                $("#recErrorMes").text("Пользователя с введённым Email не существует");
            }else{
                alert(data);
            }
            $("#sendRecBtn").prop("disabled",false);
        }
    });
});

//добавление матча
$("#setMatchBtn").on('click',function () {
    const champ = $("#matchChamp").val().trim();
    const team1 = $("#matchTeam1").val().trim();
    const team2 = $("#matchTeam2").val().trim();
    const dateAndTime = $("#matchDateAndTime").val().trim();
    const p1 = $("#matchP1").val().trim();
    const p2 = $("#matchP2").val().trim();
    const px = $("#matchPX").val().trim();
    const p1x = $("#matchP1X").val().trim();
    const p2x = $("#matchP2X").val().trim();
    const p12 = $("#matchP12").val().trim();
    const tb15 = $("#matchTB15").val().trim();
    const tb25 = $("#matchTB25").val().trim();
    const tb35 = $("#matchTB35").val().trim();
    const tm15 = $("#matchTM15").val().trim();
    const tm25 = $("#matchTM25").val().trim();
    const tm35 = $("#matchTM35").val().trim();


    $.ajax({
        url: 'ajax/addMatch.php',
        type: 'POST',
        cache: false,
        data: {'champ' : champ, 'team1': team1, 'team2': team2, 'dateAndTime': dateAndTime,
            'p1': p1, 'p2': p2, 'px': px,
            'p1x': p1x, 'p2x': p2x, 'p12': p12,
            'tb15': tb15, 'tb25': tb25, 'tb35': tb35,
            'tm15': tm15, 'tm25': tm25, 'tm35': tm35},
        beforeSend: function () {
            $("#setMatchBtn").prop("disabled",true);
        },
        success:function (data) {
            alert("Матч добавлен");
            $("#setMatchBtn").prop("disabled",false);
        }
    });
});

//переходы на хедере
$('#liveBtn').on('click',function () {
    document.location.href = 'https://virtualbet.herokuapp.com/live.php';
})
$('#mainBtn').on('click',function () {
    document.location.href = '../index.php';
})

// Переход на страницу матча
$('.matchDiv').on('click',function () {
    let id =  this.id;
    document.location.href = 'https://virtualbet.herokuapp.com/match.php?id=' + id;
});

$('.matchDivLive').on('click',function () {
    let id =  this.id;
    document.location.href = 'https://virtualbet.herokuapp.com/matchLive.php?id=' + id;
});
// Переход на страницу матча LIVE !!!!
$('.matchDivLive').on('click',function () {
    let id =  this.id;
    document.location.href = 'https://virtualbet.herokuapp.com/matchLive.php?id=' + id;
});


//Добавление ставки в купон
$(".matchBtn").on('click',function () {
            matches[$(this).parent().parent().parent().attr("id")] =
                [$(this).parent().parent().siblings(".match-logo").children(".matchInfo").children(".teams").text(),
                    $(this).parent().parent().siblings(".match-logo").children(".matchInfo").children(".dateAndTime").text(),
                    this.id,
                    this.value,
                    $(this).parent().parent().parent().attr("id"),
                    $(this).parent().parent().parent().attr("data-status")];
            localStorage.setItem('bets', JSON.stringify(matches));
            visibleBets();
})

//проверка локал сторедж
function checkBets(){
    if(localStorage.getItem('bets') != null) {
        matches = JSON.parse(localStorage.getItem('bets'));
    }
}

//отображение ставок
function visibleBets() {
            let bool = false;
            let cef = 1;
            let out = "";
            out += "<div class='coupon-head'>"
            out += "<h3 class='coupon-headline'>Игровой билет</h3>"
            out += '<button id ="UpdateCef" class="UpdateCef"><i class="fas fa-retweet"></i></button><div class="line-break"></div>';
            out += "</div>";
            for (var key in matches) {
                bool = true;
                out += "<div class='matchInBet'>";
                out += "<button data-art = "+ key +" class='deleteBetBtn'>X</button><div class=\"line-break\"></div>"
                out += "<div class='coupon-match'>"
                out += "<span class='coupon-curr-match'>" + matches[key][0] + "</span>";
                out += "<div class=\"line-break\" style='padding: 10px;'></div>"
                out += "<span class='coupon-expression'>" + matches[key][2] + "       </span>";
                out += "<span class='coupon-coff'>" + matches[key][3] + "</span>";
                out += "</div>";
                out += "<div class=\"line-break\"></div>"
                out += "</div>"
                out += "</div>";
                cef *= matches[key][3];
            }
            out += "<div class='coupon-footer'>"
            out += "<div class='coupon-footer-coff'>"
            out += "<div class='coupon-footer-coff-text'>Общий коэфициент:</div>";
            out += "<div id='cefId' class='cefDiv'>" + cef.toFixed(2) + "</div>";
            out += "</div>";
            out += "<div class='coupon-sum'>"
            out += "<span class='coupon-sum-text'>Сумма ставки:</span>";
            out += "<div class='coupon-footer-input'>";
            out += "<form>";
            out += "<input id=\"betSum\" class=\"betInp\" type=\"text\" name=\"sum\" placeholder = '0.0'>";
            out += "<span class=\"coupon-footer-money\">VCN</span>"
            out += "</div>"
            out += "</div>";
            out += "<button type=\"button\" class=\"doBetBtn\">Сделать ставку</button>";
            out += "</form>";
            out += "<div class=\"errorMes\" id=\"betErrorMes\"></div>"
            out += "</div>";
            $(".betDiv").html(out);
            $(".deleteBetBtn").on("click",deleteBet);
            $(".doBetBtn").on("click",doBet);
            $("#UpdateCef").on("click",updateCef);

            if(bool) {
                $(".betDiv").css("display", "block");
            }else {
                $(".betDiv").css("display", "none");
            }
}

// удаление ставки из купона
function deleteBet() {
    const key = $(this).attr("data-art");
    delete matches[key];
    localStorage.setItem('bets', JSON.stringify(matches));
    visibleBets();
}
// сделать ставку
function doBet() {
    let sum = Number($('#betSum').val());
    let cef = Number($('#cefId').text());
    if(sum == ''){
        $('#betErrorMes').text('Введите сумму ставки');
        return false;
    }else if(sum < 10){
        $('#betErrorMes').text('Минимальая сумма ставки - 10');
        return false;
    }else if(sum > 10000){
        $('#betErrorMes').text('Максимальная сумма ставки - 10000');
        return false;
    }

    $.ajax({
        url: 'ajax/doBet.php',
        type: 'POST',
        cache: false,
        data: {'sum' : sum, 'matches': matches, 'cef': cef},
        beforeSend: function () {
            $(".doBetBtn").prop("disabled",true);
        },
        success:function (data) {
            if(data == 'IncorrectInput'){
                $('#betErrorMes').text('Некоректный ввод')
            } else if(data == "wrongCef"){
                $('#betErrorMes').text('Коэфициэнты изменились. Обновите игровой билет');
            }else if(data == "notAuthorizeError"){
                $('#betErrorMes').text('Для ставок нужно авторизироватся');
            }else if(data == "littleValutaError"){
                $('#betErrorMes').text('На вашем счету недостаточно средств');
            }else{
                localStorage.clear();
                $(".betDiv").empty();
                document.location.href = 'https://virtualbet.herokuapp.com/index.php';
            }
            $(".doBetBtn").prop("disabled",false);
        }
    });
}

//открытие формы изменения пароля
$("#changePasswordBtn").on("click", function () {
    $(".changePasswordDiv").css('display','block');
    $(".changeNumberDiv").css('display','none');
});

//открытие формы изменения номера телефона
$("#changeNumberBtn").on("click", function () {
    $(".changePasswordDiv").css('display','none');
    $(".changeNumberDiv").css('display','block');
});

//изменение номера
$("#confirmNumberBtn").on("click", function () {
    let number = $("#numberInp").val().trim();

    if (number.match("^[0-9]{9}$") == null) {
        $("#numberErrorMes").text("номер телефона введён некорректно");
        return false;
    }

    $.ajax({
        url: 'ajax/changeNumber.php',
        type: 'POST',
        cache: false,
        data: {'number' : number},
        beforeSend: function () {
            $("#confirmNumberBtn").prop("disabled",true);
        },
        success:function (data) {
            $("#confirmNumberBtn").prop("disabled",false);

            if(data == 'NumberExistException'){
                $("#numberErrorMes").text("Номером телефона уже используется на сайте");
            }else {
                alert("Номер телефона успешно изменён!")
                $(".changeNumberDiv").css('visibility', 'hidden');
            }
        }
    });
});

//изменение пароля
$("#confirmPasswordBtn").on("click", function () {
    const lastPass = $("#lastPassImp").val().trim();
    const newPass = $("#newPassImp").val().trim();
    const confirmedPass = $("#confPassImp").val().trim();

    if(lastPass == ""||newPass == ""||confirmedPass == ""){
        $("#passErrorMes").text("Не все поля заполнены");
        return false;
    }else if(newPass != confirmedPass ){
        $("#passErrorMes").text("пароли не соответствуют");
        return false;
    }else if(newPass.length < 6){
        $("#passErrorMes").text("новый пароль слишком короткий");
        return false;
    }

    $.ajax({
        url: 'ajax/changePass.php',
        type: 'POST',
        cache: false,
        data: {'lastPass' : lastPass,'newPass' : newPass,'confirmedPass' : confirmedPass},
        beforeSend: function () {
            $("#confirmPasswordBtn").prop("disabled",true);
        },
        success:function (data) {
            $("#confirmPasswordBtn").prop("disabled",false);
            if(data == "confirmError"){
                $("#passErrorMes").text("Старый пароль введён не правильно");
            }else {
                alert("Пароль успешно изменён!");
                $(".changePasswordDiv").css('visibility', 'hidden');
            }
        }
    });
});
//рефреш счёт
$("#refreshBtn").on("click",function () {
    $.ajax({
        url: 'ajax/pay.php',
        cache: false,
        success:function (data) {
            $("#clientsBalance").text(data);
        }
    });
});
//открытие сокрытие детальной истории
$('.arrow').on('click', function () {
    if($(this).attr('data-art') == 1) {
        $(this).parent().siblings('.matchesInHistory').css('display', 'block');
        $(this).html("&#8679");
        $(this).attr('data-art',2)
    }else{
        $(this).parent().siblings('.matchesInHistory').css('display', 'none');
        $(this).html("&#8681");
        $(this).attr('data-art',1)
    }
});

//Отображение изменённых кэфов
function updateCef() {
    if(localStorage.getItem('bets') != null) {
        $.ajax({
            url: 'ajax/checkCef.php',
            type: 'POST',
            cache: false,
            data: {'matches': matches},
            beforeSend: function () {
                $("#UpdateCef").prop("disabled", true);
            },
            success: function (data) {
                $("#UpdateCef").prop("disabled", false);
                if(data != "fail"){
                    var res = $.parseJSON(data);
                    for (var key in res){
                        matches[key][3] = res[key];
                    }
                    localStorage.setItem('bets', JSON.stringify(matches));
                    visibleBets();
                }

            }

        })
    }
}
