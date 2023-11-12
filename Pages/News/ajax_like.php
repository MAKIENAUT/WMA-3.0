<?php
session_start();
require_once "../../Administrator/Admin_Database/wma_content.php";
require_once "../../Administrator/Admin_Database/wma_users.php";

if (isset($_POST['action']) && isset($_POST['content_id'])) {
   if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
      $user_id = $_SESSION['id'];
      $content_table_foreign = 'user_id';
      $content_id = $_POST['content_id'];
      $content_table = 'wma_standard_content';
      $binding_parameters = 'ii';
   } elseif (isset($_SESSION['user_token']) && !empty($_SESSION['user_token'])) {
      $user_id = $_SESSION['user_token'];
      $content_table_foreign = 'user_token';
      $content_id = $_POST['content_id'];
      $content_table = 'wma_google_content';
      $binding_parameters = 'si';
   }


   if ($_POST['action'] == 'like') {
      $like_sql = $conn->prepare("INSERT INTO $content_table ($content_table_foreign, content_id) VALUES (?, ?)");
   } elseif ($_POST['action'] == 'unlike') {
      $like_sql = $conn->prepare("DELETE FROM $content_table WHERE $content_table_foreign = ? AND content_id = ?");
   }

   if ($like_sql) {
      $like_sql->bind_param("$binding_parameters", $user_id, $content_id);
      $like_sql->execute();
      $like_sql->close();
   }

   // Get updated like count
   $count_sql = $conn->prepare("SELECT COUNT(*) FROM $content_table WHERE content_id = ?");
   $count_sql->bind_param("i", $content_id);
   $count_sql->execute();
   $count_sql->bind_result($like_count);
   $count_sql->fetch();
   $count_sql->close();

   // Ensure like_count doesn't go negative
   $like_count = max(0, $like_count);

   echo $like_count; // Return updated like count
} else {
   echo "Invalid request.";
}
?>