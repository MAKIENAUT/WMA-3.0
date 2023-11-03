<?php
require_once '../../Admin_Database/wma_users.php';

$query_google = "SELECT * FROM wma_users_google";
$result_google = $conn->query($query_google);

$google_users = [];

if ($result_google) {
   while ($row = $result_google->fetch_assoc()) {
      $google_users[] = $row;
   }

   $result_google->free();
} else {
   echo "Error: " . $conn->error;
}

$query_standard = "SELECT * FROM wma_users_standard";
$result_standard = $conn->query($query_standard);

$standard_users = [];

if ($result_standard) {
   while ($row = $result_standard->fetch_assoc()) {
      $standard_users[] = $row;
   }

   $result_standard->free();
} else {
   echo "Error: " . $conn->error;
}

$conn->close();
?>