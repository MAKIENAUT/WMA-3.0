<?php
   session_start();
   unset($_SESSION['user_token']);
   session_destroy();
   header("Location: ../Admin_Login/admin_login.php");
   exit;
?>