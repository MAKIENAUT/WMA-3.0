<?php
session_name('user_session');
session_start();
unset($_SESSION['id']);
session_destroy();
header("Location: ../Standard_User/Standard_Login/user_login.php");
exit;

?>
