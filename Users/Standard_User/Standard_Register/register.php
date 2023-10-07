<?php
// Include the database connection file
require_once '../../../Administrator/Database/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   // Retrieve form data
   $first_name = $_POST["first_name"];
   $last_name = $_POST["last_name"];
   $birthdate = $_POST["birthdate"];
   $email = $_POST["email"];
   $password = $_POST["password"];
   $confirm_password = $_POST["confirm_password"];

   // TODO: Implement form data validation
   $valid = true;

   // Validate email
   if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo "Invalid email address. ";
      $valid = false;
   }

   // Check if the email address already exists in the database
   $check_sql = "SELECT COUNT(*) FROM wma_users_standard WHERE email = ?";
   $check_stmt = $conn->prepare($check_sql);
   $check_stmt->bind_param("s", $email);
   $check_stmt->execute();
   $check_stmt->bind_result($existing_count);
   $check_stmt->fetch();
   $check_stmt->close();

   if ($existing_count > 0) {
      echo "This email address is already registered. Please use a different email.";
      $valid = false;
   }

   // Validate password
   if ($password != $confirm_password) {
      echo "Passwords do not match. ";
      $valid = false;
   }

   if ($valid) {
      // Hash the password (you should use a proper hashing method, like bcrypt)
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      // Set the base directory for user profiles
      $base_directory = '../Standard_Profile/Profile_Pictures/';

      // Create the user directory within the base directory
      $user_directory = $base_directory . $first_name . ', ' . $last_name;
      if (!is_dir($user_directory)) {
         if (!mkdir($user_directory, 0755, true)) {
            echo "Failed to create user directory.";
            exit;
         }
      }

      // Handle profile picture upload
      if ($_FILES["profile_picture"]["error"] == 0) {
         $target_dir = $user_directory . "/"; // Store profile pictures inside the user's directory
         $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);

         // Move the uploaded file to the target directory
         if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
            // Profile picture uploaded successfully
         } else {
            echo "Sorry, there was an error uploading your profile picture.";
         }
      }

      // Prepare the SQL query
      $insert_sql = "INSERT INTO wma_users_standard (first_name, last_name, birthdate, email, password, profile_picture) VALUES (?, ?, ?, ?, ?, ?)";

      // Create a prepared statement
      $stmt = $conn->prepare($insert_sql);

      // Bind parameters to the statement
      $stmt->bind_param("ssssss", $first_name, $last_name, $birthdate, $email, $hashed_password, $target_file);

      // Execute the statement
      if ($stmt->execute()) {
         echo "Registration successful!";
         // Redirect to a success page or perform other actions as needed
      } else {
         echo "Registration failed. Please try again later.";
      }

      // Close the statement
      $stmt->close();
   } else {
      echo "Registration failed. Please correct the errors.";
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="register.css">
   <title>Registration Page</title>
</head>

<body>
   <main>
      <h1>Register</h1>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
         <!-- First Name -->
         <label for="first_name">First Name:</label>
         <input type="text" name="first_name" required><br>

         <!-- Last Name -->
         <label for="last_name">Last Name:</label>
         <input type="text" name="last_name" required><br>

         <!-- Birthdate -->
         <label for="birthdate">Birthdate:</label>
         <input type="date" name="birthdate" required><br>

         <!-- Email Address -->
         <label for="email">Email Address:</label>
         <input type="email" name="email" required><br>

         <!-- Password -->
         <label for="password">Password:</label>
         <input type="password" name="password" required><br>

         <!-- Confirm Password -->
         <label for="confirm_password">Confirm Password:</label>
         <input type="password" name="confirm_password" required><br>

         <!-- Profile Picture -->
         <label for="profile_picture">Profile Picture:</label>
         <input type="file" name="profile_picture" accept="image/*"><br>
         
         <input type="submit" value="Register">
      </form>
   </main>
</body>

</html>