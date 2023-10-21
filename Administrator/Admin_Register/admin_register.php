<?php
session_start();
require_once '../Database/wma_administrator.php';

// Check if user is logged in
if (!isset($_SESSION["id"]) && empty($_SESSION["id"])) {
   header("Location: ../Admin_Login/admin_login.php");
   exit();
}

// Get user's access_credential
$user_id = $_SESSION['id'];
$query = "SELECT access_credential FROM wma_admin WHERE id = $user_id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Check if user is super admin
if ($user['access_credential'] !== 'super_admin') {
   $error = "Access credential insufficient";
   $disableFields = true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($disableFields)) {
   $email = mysqli_real_escape_string($conn, $_POST['email_address']);
   $username = mysqli_real_escape_string($conn, $_POST['username']);
   $password = mysqli_real_escape_string($conn, $_POST['password']);
   $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
   $access_credential = mysqli_real_escape_string($conn, $_POST['access_credential']);

   if ($password !== $confirm_password) {
      header("Location: admin_register.php?error=1");
      exit();
   }

   $hashed_password = password_hash($password, PASSWORD_DEFAULT);

   // Handle profile picture upload
   $targetDirectory = "../Admin_Profile/Profile_Picture/";
   $targetFile = $targetDirectory . basename($_FILES["profile_picture"]["name"]);
   $uploadOk = 1;
   $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

   if (isset($_POST["submit"])) {
      $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
      if ($check !== false) {
         $uploadOk = 1;
      } else {
         $error = "File is not an image.";
         $uploadOk = 0;
      }
   }

   if (file_exists($targetFile)) {
      $error = "Sorry, file already exists.";
      $uploadOk = 0;
   }

   if ($_FILES["profile_picture"]["size"] > 500000) {
      $error = "Sorry, your file is too large.";
      $uploadOk = 0;
   }

   if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
      $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
   }

   if ($uploadOk == 0) {
      header("Location: admin_register.php?error=3");
      exit();
   } else {
      if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $targetFile)) {
         $query = "INSERT INTO wma_admin (email_address, username, password, access_credential, profile_picture) VALUES ('$email', '$username', '$hashed_password', '$access_credential', '$targetFile')";
         $result = mysqli_query($conn, $query);

         if ($result) {
            header("Location: ../Admin_Login/admin_login.php");
            exit();
         } else {
            header("Location: admin_register.php?error=2");
            exit();
         }
      } else {
         header("Location: admin_register.php?error=4");
         exit();
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Registration</title>
</head>

<body>
   <h2>Register</h2>
   <a href="../Admin_Logout/admin_logout.php">Logout</a>
   <p>
      <?php echo $user['access_credential']; ?>
   </p>
<!-- 
   <a href="../Admin_Dashboard/Dash_Overview/dash_overview.php">hello jes</a> -->
   <?php if (isset($error)): ?>
      <div style="color: red;">
         <?php echo $error; ?>
      </div>
   <?php endif; ?>

   <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
      <label for="email_address">Email Address:</label>
      <input type="email" id="email_address" name="email_address" required <?php if (isset($disableFields))
         echo "disabled"; ?>><br><br>

      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required <?php if (isset($disableFields))
         echo "disabled"; ?>><br><br>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required <?php if (isset($disableFields))
         echo "disabled"; ?>><br><br>

      <label for="confirm_password">Confirm Password:</label>
      <input type="password" id="confirm_password" name="confirm_password" required <?php if (isset($disableFields))
         echo "disabled"; ?>><br><br>

      <label for="access_credential">Access Credential:</label>
      <select id="access_credential" name="access_credential" required <?php if (isset($disableFields))
         echo "disabled"; ?>>
         <option value="super_admin">Super Admin</option>
         <option value="admin">Admin</option>
      </select><br><br>

      <label for="profile_picture">Profile Picture:</label>
      <input type="file" id="profile_picture" name="profile_picture" accept="image/*" <?php if (isset($disableFields))
         echo "disabled"; ?>><br><br>

      <input type="submit" value="Register" <?php if (isset($disableFields))
         echo "disabled"; ?>>
   </form>
</body>

</html>