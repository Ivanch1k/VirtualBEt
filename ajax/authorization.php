<?php
session_start();
function match($result, $mail, $pass){
    while(($row = $result->fetch_assoc()) != false){
        if($row["Mail"] == $mail && $row["Pass"] == $pass){
            return $row;
        }
    }
    return false;
}
$email = $_POST['email'];
$pass = md5($_POST['pass']);
if($email != 'ogteam'&& $pass !='123456') {
    $mysql = new mysqli("localhost", "root", "", "virtualbet");
    if ($mysql->connect_errno) {
        printf("Не удалось подключиться: %s\n", $mysql->connect_error);
        exit();
    }
    $mysql->query("SET NAMES 'utf-8");
    $result = $mysql->query("SELECT * FROM client");

    $user = match($result, $email, $pass);
    if ($user != false) {
        $_SESSION["loggedUser"] = $user;
        echo "http://localhost/dashboard/virtualBet/main.php";
    } else {
        echo "false";
    }
}else{
    echo "http://localhost/dashboard/virtualBet/admin.php";
}

?>
