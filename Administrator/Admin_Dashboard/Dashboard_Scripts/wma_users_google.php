<?php
require_once '../../Database/wma_users.php';

$query = "SELECT * FROM wma_users_google";
$result = $conn->query($query);

$google_users = [];

if ($result) {
   while ($row = $result->fetch_assoc()) {
      $google_users[] = $row;
   }

   $result->free();
} else {
   echo "Error: " . $conn->error;
}

$conn->close();
?>