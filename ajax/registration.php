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

$mysql = pg_connect(getenv("DATABASE_URL"));
//существуует ли пользователь
$client = pg_query($mysql,"SELECT * FROM client WHERE Mail = '$email';");
$emailCounter = 0;
foreach ($client as $c){
    $emailCounter++;
}

// номер телефона уже зареган в базе
$client = pg_query($mysql,"SELECT * FROM client WHERE PhoneNumber = '$number';");
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
        $result = pg_query($mysql,"INSERT INTO client(Name, SecondName, DateOfBirth, Mail, PhoneNumber, Pass, Balance) VALUES('$name','$secondName','$date','$email','$number','$pass',300);");
    } else {
        $result = pg_query($mysql,"INSERT INTO client(Name, SecondName, DateOfBirth, Mail, Pass, Balance) VALUES('$name','$secondName','$date','$email','$pass',300);");
    }
    echo"https://virtualbet.herokuapp.com/index.php";
}

?>
