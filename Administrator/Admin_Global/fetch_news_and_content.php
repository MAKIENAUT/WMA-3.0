<?php
require_once '../../Admin_Database/wma.php';

$query = "SELECT * FROM wma_content";
$result = $conn->query($query);

$posts = [];

if ($result) {
   while ($row = $result->fetch_assoc()) {
      $posts[] = $row;
   }

   $result->free();
} else {
   echo "Error: " . $conn->error;
}
?>
