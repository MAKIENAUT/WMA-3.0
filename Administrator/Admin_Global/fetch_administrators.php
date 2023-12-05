<?php
require_once '../../Admin_Database/wma.php';

$query = "SELECT * FROM wma_admin";
$result = $conn->query($query);

$wma_admins = [];

if ($result) {
   while ($row = $result->fetch_assoc()) {
      $wma_admins[] = $row;
   }

   $result->free();
   $conn->close();
} else {
   echo "Error: " . $conn->error;
}
?>
