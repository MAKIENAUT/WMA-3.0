<?php
require_once '../../Admin_Database/wma_content.php';

$query = "SELECT * FROM content";
$result = $conn->query($query);

$posts = [];

if ($result) {
   while ($row = $result->fetch_assoc()) {
      $posts[] = $row;
   }

   $result->free();
   $conn->close();
} else {
   echo "Error: " . $conn->error;
}
?>
