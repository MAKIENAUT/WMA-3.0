<?php
require_once "../../Database/wma_forms.php";

// Get the email from the URL parameter
$email = $_GET['email'];

// Delete row from j1_visa table
$sql = "DELETE FROM j1_visa WHERE email_address='$email'";

if ($conn->query($sql) === TRUE) {
   // Row deleted successfully, now delete the folder

   $targetDirectory = "../../Applicant_Files/$email/";

   // Check if the directory exists
   if (is_dir($targetDirectory)) {
      // Delete the directory and its contents
      array_map('unlink', glob("$targetDirectory/*.*"));
      rmdir($targetDirectory);
   }

   // Redirect back to the file manager page
   header("Location: ../Dash_Overview/dash_overview.php");
   exit();
} else {
   echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>