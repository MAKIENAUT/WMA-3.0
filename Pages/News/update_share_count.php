<?php
require_once "../../Administrator/Admin_Database/wma_content.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $content_id = $_POST['contentId'];

   // Update or increment share_count in the wma_content.content table
   $updateShareCountSql = "UPDATE wma_content.content SET share_count = share_count + 1 WHERE id = ?";
   $updateShareCountStmt = $conn->prepare($updateShareCountSql);
   $updateShareCountStmt->bind_param("i", $content_id);

   if ($updateShareCountStmt->execute()) {
      // Fetch the updated share_count and return it as a response
      $selectShareCountSql = "SELECT share_count FROM wma_content.content WHERE id = ?";
      $selectShareCountStmt = $conn->prepare($selectShareCountSql);
      $selectShareCountStmt->bind_param("i", $content_id);
      $selectShareCountStmt->execute();
      $selectShareCountStmt->bind_result($updatedShareCount);
      $selectShareCountStmt->fetch();
      $selectShareCountStmt->close();

      echo $updatedShareCount;
   } else {
      echo "Error updating share count: " . $updateShareCountStmt->error;
   }

   $updateShareCountStmt->close();
} else {
   echo "Invalid request.";
}
?>