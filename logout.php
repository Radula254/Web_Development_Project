<?php
session_start();

//Check if the user is Logged in
if (isset($_SESSION['email'])) {
    //If logged in, destroy the session and redirect to the home page
    session_destroy();
    header("Location: index.html");
    exit();
}else {
    //If not logged in, redirect to the login page
    header("Location: Login.php");
    exit();
}
?>