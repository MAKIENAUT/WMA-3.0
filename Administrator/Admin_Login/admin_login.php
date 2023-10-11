<?php
require_once '../Database/database.php';

if (isset($_SESSION["id"]) && !empty($_SESSION["id"])) {
   header("location: ../../../Pages/Home/home.php");
   exit;
}

$email = $password = "";
$email_err = $password_err = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $email = $_POST["email"];
   $password = $_POST["password"];

   if (empty($email)) {
      $email_err = "Please enter your email.";
   }

   if (empty($password)) {
      $password_err = "Please enter your email.";
   }

   if (empty($email_err) && empty($password_err)) {
      // Prepare the SQL query to fetch user data
      $sql = "SELECT id, first_name, last_name, email, password, profile_picture FROM wma_users_standard WHERE email = ?";
      $stmt = $conn->prepare($sql);

      if ($stmt) {
         $stmt->bind_param("s", $email);
         $stmt->execute();
         $stmt->store_result();

         if ($stmt->num_rows == 1) {
            // Bind the result variables
            $stmt->bind_result($id, $first_name, $last_name, $db_email, $db_password, $profile_picture);
            if ($stmt->fetch()) {
               // Verify the password
               if (password_verify($password, $db_password)) {
                  // Password is correct, start a new session
                  session_start();

                  // Store data in session variables
                  $_SESSION["id"] = $id;
                  $_SESSION["email"] = $email;
                  $_SESSION["first_name"] = $first_name; // Add first name
                  $_SESSION["last_name"] = $last_name; // Add last name
                  $_SESSION["profile_picture"] = $profile_picture; // Add profile picture

                  // Redirect to a welcome page
                  header("location: ../../../Pages/Home/home.php");
                  exit;
               } else {
                  // Display an error message if the password is incorrect
                  $password_err = "The password you entered is incorrect.";
               }
            }
         } else {
            // Display an error message if the email is not found
            $email_err = "No account found with that email.";
         }

         // Close the statement
         $stmt->close();
      } else {
         // Handle the SQL error
         die("Error in SQL query: " . $conn->error);
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>

</body>

</html>