<?php
require_once '../../../Administrator/Admin_Database/wma_users.php';

$errors = []; // Initialize an array to store error messages

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $first_name = $_POST["first_name"];
   $last_name = $_POST["last_name"];
   $phone_number = $_POST["phone_number"];
   $birth_date = $_POST["birth_date"];
   $email = $_POST["email"];
   $password = $_POST["password"];
   $confirm_password = $_POST["confirm_password"];

   $valid = true;

   if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors[] = "Invalid email address.";
      $valid = false;
   }

   $check_sql = "SELECT COUNT(*) FROM wma_users_standard WHERE email = ?";
   $check_stmt = $conn->prepare($check_sql);
   $check_stmt->bind_param("s", $email);
   $check_stmt->execute();
   $check_stmt->bind_result($existing_count);
   $check_stmt->fetch();
   $check_stmt->close();

   if ($existing_count > 0) {
      $errors[] = "This email address is already registered. Please use a different email.";
      $valid = false;
   }

   if ($password != $confirm_password) {
      $errors[] = "Passwords do not match.";
      $valid = false;
   }

   if ($valid) {
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      $base_directory = '../Standard_Profile/Profile_Pictures/';

      $user_directory = $base_directory . $email; // Use email as directory name
      if (!is_dir($user_directory)) {
         if (!mkdir($user_directory, 0755, true)) {
            $errors[] = "Failed to create user directory.";
            exit;
         }
      }

      if ($_FILES["profile_picture"]["error"] == 0) {
         $target_dir = $user_directory . "/";
         $target_file = $target_dir . 'profile_picture.jpg'; // Rename the file

         if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
            // File uploaded successfully
         } else {
            $errors[] = "Sorry, there was an error uploading your profile picture.";
         }
      }

      $insert_sql = "INSERT INTO wma_users_standard (first_name, last_name, phone_number, birth_date, email, password, profile_picture) VALUES (?, ?, ?, ?, ?, ?, ?)";

      $stmt = $conn->prepare($insert_sql);

      $stmt->bind_param("sssssss", $first_name, $last_name, $phone_number, $birth_date, $email, $hashed_password, $target_file);

      if ($stmt->execute()) {
         header("location: ../../Standard_User/Standard_Login/user_login.php");
         exit;
      } else {
         $errors[] = "Registration failed. Please try again later.";
      }

      $stmt->close();
   } else {
      $errors[] = "Registration failed. Please correct the errors.";
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
   <link rel="stylesheet" href="register.css">
   <link rel="stylesheet" href="/Pages/Global/global.css" />
   <script src="https://www.google.com/recaptcha/api.js" async defer></script>
   <link rel="icon" type="image/x-icon" href="/Photos/WMA.png">
   <title>Registration Page</title>
</head>

<body>
   <main>
      <div class="form">
         <a href="/Pages/Home/home.php" class="home-button"><i class="fa-solid fa-arrow-left"></i>&nbsp;home</a>
         <h1>Register</h1>
         <div class="error_handler">
            <?php
            if (!empty($errors)) {
               foreach ($errors as $error) {
                  echo $error . "<br>";
               }
            }
            ?>
         </div>
         <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
            enctype="multipart/form-data">
            <div class="personal-info">
               <div class="name_fields">
                  <label>Personal Information <b>*</b></label>
                  <div class="name_inputs">
                     <input type="text" name="first_name" required placeholder="First Name">
                     <input type="text" name="last_name" required placeholder="Last Name">
                  </div>
               </div>
               <div class="miscellaneous_fields">
                  <div class="miscellaneous_inputs">
                     <input type="tel" name="phone_number" required placeholder="Phone Number">
                     <input type="date" name="birth_date" required placeholder="Birth Date">
                  </div>
               </div>
               <div class="email_field">
                  <input type="email" name="email" required placeholder="Email Address"><br>
               </div>
            </div>
            <div class="password_fields">
               <label>Password<b>*</b></label>
               <div class="password_inputs">
                  <input type="password" name="password" required placeholder="Password">
                  <input type="password" name="confirm_password" required placeholder="Confirm Password">
               </div>
            </div>
            <div class="pfp_input">
               <label for="profile">Profile Picture (.jpg only) <b>*</b></label>
               <div class="pfp_field" id="pfp_field">
                  <div class="subtitle">Click/drag & drop your Profile Picture here</div>
                  <input type="file" id="profile_picture" class="file_input_field" name="profile_picture" accept=".jpg"
                     required>
                  <div class="file_name" id="pfp_name"></div>
               </div>
            </div>
            <script src="register.js"></script>
            <div class="g-recaptcha" data-sitekey="6LfaUYkoAAAAAK9Qg6i0SqqoW7mF0ioNFkCb1EPz"></div>
            <input type="submit" value="Register">
         </form>
         <p>Already have an account? <a href="../Standard_Login/user_login.php">Login</a></p>
      </div>
   </main>
</body>

</html>