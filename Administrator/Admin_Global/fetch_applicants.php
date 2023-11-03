<?php
require_once '../../Admin_Database/wma_applicants.php';

$query = "SELECT * FROM j1_visa";
$result = $conn->query($query);

$applicants = [];

if ($result) {
   while ($row = $result->fetch_assoc()) {
      $applicants[] = $row;
   }

   $result->free();
} else {
   echo "Error: " . $conn->error;
}

?>