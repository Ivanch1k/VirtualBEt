<?php
require 'fun.php';
require 'authorizedHeader.php';
$id = $_SESSION["loggedUser"]["Id"];
$name = $_SESSION["loggedUser"]["Name"];
$secondName = $_SESSION["loggedUser"]["SecondName"];
$owner = "$name $secondName";
?>

<div id="settingsDiv" class="settingsDiv">
    <span class="settingsSpan" id="idSpan">Номер счёта: <?php echo $id?></span></br>
    <span class="settingsSpan" id="nameSpan">Владелец аккаунта: <?php echo $owner?></span></br>
    <button id="changePasswordBtn" class="settingsBtn">Изменить пароль</button></br>
    <button id="changeNumberBtn" class="settingsBtn">Изменить номер телефона</button></br>
</div>

<div class="changePasswordDiv">
    <span>Изменить пароль</span>
    <form>
        <span>Старый пароль</span><input id="lastPassImp" class="formReg" type="password" name="lastPass" ></br>
        <span>Новый пароль</span><input id="newPassImp" class="formReg" type="password" name="newPass" ></br>
        <span>Подтвердите пароль</span><input id="confPassImp" class="formReg" type="password" name="confPass" ></br>
        <button type="button" id="confirmPasswordBtn">Подтвердить</button>
    </form>
    <div class="errorMes" id="passErrorMes"></div>
</div>

<div class="changeNumberDiv">
    <span>Изменить номер телефона</span>
    <form>
        <span>+380 </span>
        <input id="numberInp" class="formReg" type="text" name="number" placeholder="номер телефона"></br>
        <button type="button" id="confirmNumberBtn">Подтвердить</button>
    </form>
    <div class="errorMes" id="numberErrorMes"></div>
</div>
<?php
require "footer.php";
?>
