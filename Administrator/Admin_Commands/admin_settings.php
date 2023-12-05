<?php
require_once "page_initiators.php";
require_once '../Admin_Database/wma.php';

if (isset($admin_id)) {
   $user_id = $admin_id;
   $query = "SELECT * FROM wma_admin WHERE id = $user_id";
   $result = mysqli_query($conn, $query);
   $user = mysqli_fetch_assoc($result);
}

// Check if user is super admin
if ($access_credential !== 'super_admin') {
   $error = "You won't be able to change your Access Credential.";
   $disableFields = true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $email = $_POST["email_address"];
   $username = $_POST["username"];
   $password = $_POST["password"];
   $confirm_password = $_POST["confirm_password"];
   $access_credential = $_POST["access_credential"];

   // Basic validation
   if (empty($email) || empty($username) || empty($access_credential)) {
      $error = "All fields except password are required.";
   } else if (!empty($password) && $password != $confirm_password) {
      $error = "Passwords do not match.";
   } else {
      // Password hashing
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      // Handle profile picture upload
      if ($_FILES['profile_picture']['size'] > 0) {
         $target_directory = '../Admin_Profile/Profile_Picture/';
         $target_file = $target_directory . $email . '.jpg';
         $uploadOk = 1;
         $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

         // Check if image file is a actual image or fake image
         $check = getimagesize($_FILES['profile_picture']['tmp_name']);
         if ($check !== false) {
            $uploadOk = 1;
         } else {
            $error = "File is not an image.";
            $uploadOk = 0;
         }

         // Allow certain file formats
         if ($imageFileType != "jpg" && $imageFileType != "jpeg") {
            $error = "Sorry, only JPG and JPEG files are allowed.";
            $uploadOk = 0;
         }

         if ($uploadOk == 1) {
            // Remove existing file
            if (file_exists($target_file)) {
               unlink($target_file);
            }

            // Upload new file
            if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file)) {
               // File uploaded successfully
            } else {
               $error = "Sorry, there was an error uploading your file.";
            }
         }
      }

      // Update user information in the database
      $update_query = "UPDATE wma_admin SET email_address = '$email', username = '$username', access_credential = '$access_credential'";

      if (!empty($password)) {
         $update_query .= ", password = '$hashed_password'";
      }

      $update_query .= " WHERE id = $user_id";

      if ($uploadOk == 1 && mysqli_query($conn, $update_query)) {
         $success_message = "Profile updated successfully!";
         // You can redirect the user to another page or display a success message here
      } else {
         $error = "Error updating profile: " . mysqli_error($conn);
      }
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <link rel="stylesheet" href="admin_commands.css">
   <link rel="icon" type="image/x-icon" href="/Photos/WMA.png">
   <link rel="stylesheet" href="../../../Pages/Global/global.css" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Profile Settings</title>
</head>

<body>
   <main>
      <a href="../Admin_Dashboard/Overview/overview.php">home</a>
      <h2>Edit Profile</h2>
      <p>
         <?php echo $user['access_credential']; ?>
      </p>
      <?php if (isset($error)): ?>
         <div style="color: red;">
            <?php echo $error; ?>
         </div>
      <?php endif; ?>

      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
         <div class="email_field">
            <label for="email_address">Email Address:</label>
            <input required type="email" id="email_address" name="email_address" value="<?php echo $admin_email ?>" />
         </div>

         <div class="username_field">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required value="<?php echo $admin_username ?>">
         </div>

         <div class="password_field">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
         </div>

         <div class="confirm_field">
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
         </div>

         <div class="credential_field">
            <label for="access_credential" <?php if (isset($disableFields))
               echo "style = 'display: none;'"; ?>>Access
               Credential:</label>
            <select id="access_credential" name="access_credential" value="<?php echo $access_credential ?>" required <?php if (isset($disableFields))
                  echo "style = 'display: none;'"; ?>>
               <option value="super_admin">Super Admin</option>
               <option value="admin">Admin</option>
            </select>
         </div>

         <div class="pfp_field">
            <label for="profile_picture">Profile Picture:</label>
            <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
         </div>

         <input type="submit" value="Register">
      </form>
   </main>
</body>

</html>