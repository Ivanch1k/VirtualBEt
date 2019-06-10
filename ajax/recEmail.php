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



$mysql = pg_connect(getenv("DATABASE_URL"));

    $mails = pq_query($mysql,"SELECT * FROM client WHERE Mail = '$email'");
    $counter = 0;
    foreach ($mails as $e){
        $counter++;
    }


    if ($counter > 0) {
        echo $randomPass;
        mail($email,$subject,$message);
        $randomPass = md5($randomPass);
        pq_query($mysql,"UPDATE client SET Pass = '$randomPass' WHERE Mail = '$email'");
    } else {
        echo "false";
    }


