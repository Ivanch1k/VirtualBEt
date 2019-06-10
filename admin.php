<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>VirtualBet</title>
</head>
<body>
<form>
    <span>Чемпионат </span><input id="matchChamp" class="formReg" type="text" name="champ" placeholder="Чемпионат"></br>
    <span>Команда 1  </span><input id="matchTeam1" class="formReg" type="text" name="team1" placeholder="Команда 1"></br>
    <span>Команда 2  </span><input id="matchTeam2" class="formReg" type="text" name="team2" placeholder="Команда 2"></br>
    <span>Дата и время  </span><input id="matchDateAndTime" class="formReg" type="datetime-local" name="dateAndTime" ></br>
    <span>П1 </span><input id="matchP1" class="formReg" type="text" name="P1" placeholder="P1"></br>
    <span>П2  </span><input id="matchP2" class="formReg" type="text" name="P2" placeholder="P2"></br>
    <span>ПХ  </span><input id="matchPX" class="formReg" type="text" name="PX" placeholder="PX"></br>
    <span>П1X </span><input id="matchP1X" class="formReg" type="text" name="P1X" placeholder="P1X"></br>
    <span>П2X  </span><input id="matchP2X" class="formReg" type="text" name="P2X" placeholder="P2X"></br>
    <span>П12  </span><input id="matchP12" class="formReg" type="text" name="P12" placeholder="P12"></br>
    <span>TB15 </span><input id="matchTB15" class="formReg" type="text" name="TB15" placeholder="TB15"></br>
    <span>TB25  </span><input id="matchTB25" class="formReg" type="text" name="TB25" placeholder="TB25"></br>
    <span>TB35  </span><input id="matchTB35" class="formReg" type="text" name="TB35" placeholder="TB35"></br>
    <span>TM15 </span><input id="matchTM15" class="formReg" type="text" name="TM15" placeholder="TM15"></br>
    <span>TM25  </span><input id="matchTM25" class="formReg" type="text" name="TM25" placeholder="TM25"></br>
    <span>TM35  </span><input id="matchTM35" class="formReg" type="text" name="TM35" placeholder="TM35"></br>
    <button type="button" id="setMatchBtn">Отправить</button>
</br></br></br>
<a href="https://virtualbet.herokuapp.com/getWinner.php"> Проверить купоны</a>
    <a href="https://virtualbet.herokuapp.com/parser.php"> Обновить матчи</a>
</form>
<?php
require 'footer.php';
?>