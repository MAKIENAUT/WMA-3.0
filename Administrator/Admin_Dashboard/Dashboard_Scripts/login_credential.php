<?php
if (!isset($_SESSION['admin_id']) || empty($_SESSION['admin_id'])) {
   header('Location: ../../Admin_Login/admin_login.php');
   exit();
}
?>