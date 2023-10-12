<?php
session_start();
require_once '../Database/database.php';

if (!isset($_SESSION["id"]) && empty($_SESSION["id"])) {
   header("Location: ../Admin_Register/admin_register.php");
   exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $email = mysqli_real_escape_string($conn, $_POST['email_or_username']);
   $password = mysqli_real_escape_string($conn, $_POST['password']);

   $query = "SELECT * FROM wma_admin WHERE email_address = '$email'";
   $result = mysqli_query($conn, $query);

   if ($result) {
      $user = mysqli_fetch_assoc($result);

      if ($user && password_verify($password, $user['password'])) {
         $_SESSION['id'] = $user['id'];
         $_SESSION['email_address'] = $user['email_address'];
         $_SESSION['username'] = $user['username'];
         $_SESSION['access_credential'] = $user['access_credential'];

         header("Location: ../Admin_Register/admin_register.php");
         exit();
      } else {
         header("Location: admin_login.php?error=1");
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
   <title>Login Page</title>
</head>

<body>
   <h2>Login</h2>
   <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <label for="email_or_username">Email Address:</label>
      <input type="email" id="email_or_username" name="email_or_username" required><br><br>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required><br><br>

      <input type="submit" value="Login">
   </form>
</body>

</html>