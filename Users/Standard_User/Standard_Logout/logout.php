<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION["id"]) && !empty($_SESSION["id"])) {
    // If the user is logged in, destroy the session and redirect to the login page
    session_destroy();
    header("location: ../Standard_Login/user_login.php");
    exit;
} else {
    // If the user is not logged in, redirect to the login page
    header("location: ../Standard_Login/user_login.php");
    exit;
}
?>