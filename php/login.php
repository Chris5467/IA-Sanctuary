<?php

include("connectdb.php");
$db = connectDb();

// checks whether username entered
if (!empty(trim($_POST['username']))) {
    $username = $_POST['username'];
} else {
    echo("Pls input your username");
    exit;
}
// checks whether password entered
if (!empty(trim($_POST['password']))) {
    $password = hash("sha256", $_POST['password']);
} else {
    exit ("You forgot to enter your password!");
}

try {
    // use the form data to create a insert SQL and  add a vehicle record  
    $stm = $db->prepare("SELECT * FROM `users` WHERE `username`=? AND `password`=?");
    $stm->execute(array($username, $password));
    if ($stm->rowCount() > 0) {
        echo("Logged in");
        session_start();
        $_SESSION["username"] = $username;
        if ($stm->fetchColumn(2) == 1) {
            header("Location: /staff.php");
            $_SESSION["staff"] = true;
        } else {
            $_SESSION["staff"] = false;
            header("Location: /home.php");
        }
    } else {
        header("Location: /login.html");
    }

} catch (PDOException $ex) {
    //this catches the exception when it is thrown
    echo "Sorry, a database error occurred when trying to insert a record. Please try again.<br> ";
    echo "Error details:" . $ex->getMessage();
}

?>