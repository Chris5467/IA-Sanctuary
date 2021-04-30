<?php

include("connectdb.php");
$db = connectDb();

// checks whether username entered
$username = $_POST['username'];
if (!empty(trim($username))) {
    if (!isUsernameValid($username)) {
        header("Location: /login.html");
        exit;
    }
} else {
    echo("Pls input your username");
    exit;
}

// checks whether password entered
$password = $_POST['password'];
if (!empty(trim($password))) {
    if (!isPasswordValid($password)) {
        header("Location: /login.html");
        exit;
    }
    $passwordDigest = hash("sha256", $_POST['password']);
} else {
    exit ("You forgot to enter your password!");
}

try {
    // use the form data to create a insert SQL and  add a vehicle record  
    $stm = $db->prepare("INSERT INTO `users`(`username`, `password`) VALUES(?,?)");
    $stm->execute(array($username, $passwordDigest));
    header("Location: /login.html");
} catch (PDOException $ex) {
    //this catches the exception when it is thrown
    echo "Sorry, a database error occurred when trying to insert a record. Please try again.<br> ";
    echo "Error details:" . $ex->getMessage();
}

function isUsernameValid($username)
{
    if (strlen($username) > 16 || strlen($username) < 1) {
        return false;
    }
    return true;
}

function isPasswordValid($password)
{
    if (strlen($password) > 16 || strlen($password) < 1) {
        return false;
    }
    return true;
}

?>