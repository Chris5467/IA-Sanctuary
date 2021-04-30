<?php

include("../session_handler.php");
include("../connectdb.php");

if (!isLoggedInAsStaff()) {
    header("Location: /login.html");
    exit;
}

$animal_id = $_POST['animal_ID'];
$username = $_POST['username'];

$db = connectDb();

$stm = $db->prepare("UPDATE `adoption_requests` SET `adoption_status`=? WHERE `animal_id`=? AND `username`=?");
$stm->execute(array("DENIED", $animal_id, $username));