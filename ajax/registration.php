<?php
    session_start();
    $email = $_POST['email'];
    $name = $_POST['name'];
    $secondName = $_POST['secondName'];
    $date = $_POST['date'];
    $pass = md5($_POST['pass']);
    $num = $_POST['number'];
    $number = "+380";
    $number = $number."".$num;
$mysql = new mysqli("localhost","root","","virtualbet");
if ($mysql->connect_errno) {
    printf("Не удалось подключиться: %s\n", $mysql->connect_error);
    exit();
}
$mysql->query("SET NAMES 'utf-8");

//существуует ли пользователь
$client = $mysql->query("SELECT * FROM client WHERE Mail = '$email';");
$emailCounter = 0;
foreach ($client as $c){
    $emailCounter++;
}

// номер телефона уже зареган в базе
$client = $mysql->query("SELECT * FROM client WHERE PhoneNumber = '$number';");
$numberCounter = 0;
foreach ($client as $c){
    $numberCounter++;
}
//

if($emailCounter > 0){
    echo "UserExistException";
}else if($numberCounter > 0){
    echo "NumberExistException";
} else {
    if ($number != "+380") {
        $result = $mysql->query("INSERT INTO client(Name, SecondName, DateOfBirth, Mail, PhoneNumber, Pass, Balance) VALUES('$name','$secondName','$date','$email','$number','$pass',300);");
    } else {
        $result = $mysql->query("INSERT INTO client(Name, SecondName, DateOfBirth, Mail, Pass, Balance) VALUES('$name','$secondName','$date','$email','$pass',300);");
    }
    echo"http://localhost/dashboard/virtualBet/main.php";
}

?>
