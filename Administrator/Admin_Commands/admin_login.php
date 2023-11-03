<?php

require_once '../Admin_Database/wma_administrators.php';

session_name('admin_session');
session_start();

if (isset($admin_id) && !empty($admin_id)) {
   header('Location: ../Admin_Dashboard/Overview/overview.php');
   exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $email = mysqli_real_escape_string($conn, $_POST['email_address']);
   $password = mysqli_real_escape_string($conn, $_POST['password']);

   $query = "SELECT * FROM wma_admin WHERE email_address = '$email'";
   $result = mysqli_query($conn, $query);

   if ($result) {
      $user = mysqli_fetch_assoc($result);

      if ($user && password_verify($password, $user['password'])) {
         $_SESSION['admin_id'] = $user['id'];
         $_SESSION['email_address'] = $user['email_address'];
         $_SESSION['username'] = $user['username'];
         $_SESSION['access_credential'] = $user['access_credential'];
         $_SESSION['last_activity'] = time(); // Store the timestamp of the last activity

         // Update the last login time in the database
         $currentDateTime = date('Y-m-d H:i:s');
         $updateQuery = "UPDATE wma_admin SET last_login = '$currentDateTime' WHERE id = " . $user['id'];
         mysqli_query($conn, $updateQuery);

         header("Location: ../Admin_Dashboard/Overview/overview.php");
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
   <link rel="stylesheet" href="admin_commands.css">
   <link rel="icon" type="image/x-icon" href="/Photos/WMA.png">
   <link rel="stylesheet" href="../../../Pages/Global/global.css" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Login</title>
</head>

<body>
   <main>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

         <h2>Administrator Login</h2>
         <div class="email_field">
            <label for="email_address"><b>* </b>Email Address:</label>
            <input type="email" id="email_address" name="email_address" placeholder="Enter Email" required>
         </div>

         <div class="password_field">
            <label for="password"><b>* </b>Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter Password" required>
         </div>

         <input type="submit" value="Login">
      </form>
   </main>
</body>

</html>