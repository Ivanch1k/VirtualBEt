<?php
session_start();
unset($_SESSION["loggedUser"]);

header("Location: https://virtualbet.herokuapp.com/index.php");