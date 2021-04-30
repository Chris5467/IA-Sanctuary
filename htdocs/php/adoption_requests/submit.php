<?php

include("../session_handler.php");
include("../connectdb.php");

if (!isLoggedIn()) {
    header("Location: /login.html");
    exit;
}

$id = $_POST['animal_ID'];

$db = connectDb();

$stm = $db->prepare("INSERT INTO `adoption_requests`(`animal_ID`, `username`) VALUES(?,?)");
$stm->execute(array($id, $_SESSION["username"]));
