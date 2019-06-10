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
    $mysql = pg_connect(getenv("DATABASE_URL"));
    $result = pq_query($mysql,"SELECT * FROM client");

    $user = match($result, $email, $pass);
    if ($user != false) {
        $_SESSION["loggedUser"] = $user;
        echo "https://virtualbet.herokuapp.com/index.php";
    } else {
        echo "false";
    }
}else{
    echo "
    admin.php";
}

?>
