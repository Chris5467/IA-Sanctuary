<?php

session_start();

function isLoggedIn()
{
    return isset($_SESSION["username"]);
}

function isLoggedInAsStaff()
{
    return isLoggedIn() && isset($_SESSION["staff"]) && $_SESSION["staff"] == true;
}