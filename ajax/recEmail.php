<?php

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$subject = "VirtualBet новый пароль";
$randomPass = generateRandomString(10);
$message = "Ваш новый пароль на сайте VirtualBet: ".$randomPass;
$email = $_POST['email'];



    $mysql = new mysqli("localhost", "root", "", "virtualbet");
    if ($mysql->connect_errno) {
        printf("Не удалось подключиться: %s\n", $mysql->connect_error);
        exit();
    }
    $mysql->query("SET NAMES 'utf-8");

    $mails = $mysql->query("SELECT * FROM client WHERE Mail = '$email'");
    $counter = 0;
    foreach ($mails as $e){
        $counter++;
    }


    if ($counter > 0) {
        echo $randomPass;
        mail($email,$subject,$message);
        $randomPass = md5($randomPass);
        $mysql->query("UPDATE client SET Pass = '$randomPass' WHERE Mail = '$email'");
    } else {
        echo "false";
    }


