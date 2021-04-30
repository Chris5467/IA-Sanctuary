<?php

include("session_handler.php");

if (!isLoggedInAsStaff()) {
    header("Location: /login.html");
    exit;
}

include("connectdb.php");
$db = connectDb();

if (!empty(trim($_POST['animal_name']))) {
    $animal_name = $_POST['animal_name'];
} else {
    header("Location: ../staff.php");
}

if (!empty(trim($_POST['date']))) {
    $date = $_POST['date'];
} else {
    header("Location: ../staff.php");
}

if (!empty(trim($_POST['description']))) {
    $description = $_POST['description'];
} else {
    header("Location: ../staff.php");
}

$stm = $db->prepare("INSERT INTO `animals`(`animal_name`, `date_of_birth`, `description`, `picture`) VALUES(?,?,?,?)");
$stm->execute(array($animal_name, $date, $description, 1));
header("Location: ../staff.php");
