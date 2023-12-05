<?php
session_start();


require_once '../../User_Login_Google/config.php';


// Check if the user is already logged in
if (isset($_SESSION["id"]) && !empty($_SESSION["id"])) {
   header("location: ../../../Pages/Home/home.php");
   exit;
}

// Include the database connection file
require_once '../../../Administrator/Admin_Database/wma.php';

// Initialize variables for email and password
$email = $password = "";
$email_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   // Retrieve form data
   $email = $_POST["email"];
   $password = $_POST["password"];

   // Validate email and password
   if (empty($email)) {
      $email_err = "Please enter your email.";
   }

   if (empty($password)) {
      $password_err = "Please enter your password.";
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
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
      integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
      crossorigin="anonymous" referrerpolicy="no-referrer">
   <link rel="stylesheet" href="user_login.css">
   <link rel="stylesheet" href="/Pages/Global/global.css" />
   <link rel="icon" type="image/x-icon" href="/Photos/WMA.png">
   <script defer src="user_login.js"></script>
   <title>WMA Login</title>
</head>

<body>
   <main>
      <div class="form">
         <a href="/Pages/Home/home.php" class="home-button"><i class="fa-solid fa-arrow-left"></i>&nbsp;home</a>
         <h1>Login</h1>
         <div class="error_display">
            <?php echo $email_err; ?>
            <?php echo $password_err; ?>
         </div>
         <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <!-- Email Address -->
            <div class="email_field">
               <label for="email">Email Address:</label>
               <input type="email" name="email" value="<?php echo $email; ?>" placeholder="Enter Email Address"
                  required>
            </div>
            <!-- Password -->
            <div class="password_field">
               <label for="password">
                  Password:
                  <!-- Password View Toggle -->
                  <div class="view_toggle">
                     <span id="eye" class="fa-regular fa-eye" style="cursor:pointer;" onclick="togglePassword()"></span>
                     <span id="eye-slash" class="fa-regular fa-eye-slash" style="cursor:pointer; display:none;"
                        onclick="togglePassword()"></span>
                  </div>
               </label>
               <input type="password" name="password" id="password" placeholder="Enter Password" required>
            </div>
            <div class="login_option">
               <input type="submit" value="Sign In">
               <p>Or</p>
               <?php
               if (isset($_SESSION['user_token'])) {
                  header("Location: welcome.php");
               } else { ?>
                  <a href="<?php echo $client->createAuthUrl();  ?>">
                     <img src="../../../Photos/Google_Logo.svg" alt="">
                     Sign Up with Google
                  </a>
                  <?php
               }
               ?>
            </div>
         </form>
         <div class="register_link">
            <p>Don't have an account yet?</p>
            <a href="../Standard_Register/register.php">Create an Account.</a>
         </div>
      </div>
   </main>
</body>

</html>