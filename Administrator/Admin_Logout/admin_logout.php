<?php
session_name('admin_session');
session_start();
require_once '../Database/wma_administrator.php';

if (isset($_SESSION["admin_id"])) {
   // Update the last logout time in the database
   $currentDateTime = date('Y-m-d H:i:s');
   $updateQuery = "UPDATE wma_admin SET last_logout = '$currentDateTime' WHERE id = " . $_SESSION['admin_id'];
   mysqli_query($conn, $updateQuery);

   // Unset and destroy the session
   unset($_SESSION['admin_id']);
   session_destroy();

   header("Location: ../Admin_Login/admin_login.php");
   exit();
}
?>