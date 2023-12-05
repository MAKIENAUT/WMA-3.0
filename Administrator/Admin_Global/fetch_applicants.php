<?php
require_once '../../Admin_Database/wma.php';

$applicant_query = "SELECT * FROM j1_visa";
$applicant_result = $conn->query($applicant_query);

$applicants = [];

if ($applicant_result) {
   while ($row = $applicant_result->fetch_assoc()) {
      $applicants[] = $row;
   }

   $applicant_result->free();
} else {
   echo "Error: " . $conn->error;
}

$employers_query = "SELECT * FROM school_partners_form";
$employers_result = $conn->query($employers_query);

$employers = [];

if ($employers_result) {
   while ($row = $employers_result->fetch_assoc()) {
      $employers[] = $row;
   }

   $employers_result->free();
} else {
   echo "Error: " . $conn->error;
}
?>