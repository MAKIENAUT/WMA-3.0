<?php
session_start();
unset($_SESSION['id']);
unset($_SESSION['user_token']);
session_destroy();
header("Location: ../Standard_User/Standard_Login/user_login.php");
exit;

?>