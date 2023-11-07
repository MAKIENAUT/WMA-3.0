<?php
session_name('admin_session');
session_start();

if (!isset($_SESSION['admin_id']) || empty($_SESSION['admin_id'])) {
   header('Location: admin_login.php');
   exit();
}

$admin_id = $_SESSION['admin_id'];
$admin_username = $_SESSION['username'];
$admin_email = $_SESSION['email_address'];
$last_activity = $_SESSION['last_activity'];
$access_credential = $_SESSION['access_credential'];
?>