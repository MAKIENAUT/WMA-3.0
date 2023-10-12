<?php
session_start();
require_once '../Database/database.php';

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
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $username = mysqli_real_escape_string($conn, $_POST['username']);
   $password = mysqli_real_escape_string($conn, $_POST['password']);
   $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
   $access_credential = mysqli_real_escape_string($conn, $_POST['access_credential']);

   if ($password !== $confirm_password) {
      header("Location: admin_register.php?error=1");
      exit();
   }

   $hashed_password = password_hash($password, PASSWORD_DEFAULT);

   $query = "INSERT INTO wma_admin (email_address, username, password, access_credential) VALUES ('$email', '$username', '$hashed_password', '$access_credential')";
   $result = mysqli_query($conn, $query);

   if ($result) {
      header("Location: ../Admin_Login/admin_login.php");
      exit();
   } else {
      header("Location: admin_register.php?error=2");
      exit();
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
   <p>
      <?php echo $user['access_credential']; ?>
   </p>

   <?php if (isset($error)): ?>
      <div style="color: red;">
         <?php echo $error; ?>
      </div>
   <?php endif; ?>



   <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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

      <input type="submit" value="Register" <?php if (isset($disableFields))
         echo "disabled"; ?>>
   </form>
</body>

</html>