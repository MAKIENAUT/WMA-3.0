<?php
require_once "../../../Administrator/Admin_Database/wma.php";

session_start();

$errors = "";

if (!isset($_SESSION['user_token']) && !isset($_SESSION['id'])) {
   header("Location: ../../../Users/Standard_User/Standard_Login/user_login.php");
   die();
}

if (isset($_SESSION['user_token'])) {
   $credentialType = 'google_login';
   $user_table = 'wma_users.wma_users_google';
   $user_id = $_SESSION['user_token'];
   $table_key = 'token';
} elseif (isset($_SESSION['id'])) {
   $credentialType = 'standard_login';
   $user_table = 'wma_users.wma_users_standard';
   $user_id = $_SESSION['id'];
   $table_key = 'id';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   // Sanitize and escape the input to prevent SQL injection
   $first_name = mysqli_real_escape_string($conn, $_POST["first_name"]);
   $middle_name = mysqli_real_escape_string($conn, $_POST["middle_name"]);
   $last_name = mysqli_real_escape_string($conn, $_POST["last_name"]);
   $school_district = mysqli_real_escape_string($conn, $_POST["school_district"]);
   $full_address = mysqli_real_escape_string($conn, $_POST["full_address"]);
   $city = mysqli_real_escape_string($conn, $_POST["city"]);
   $state = mysqli_real_escape_string($conn, $_POST["state"]);
   $country = mysqli_real_escape_string($conn, $_POST["country"]);
   $email_address = mysqli_real_escape_string($conn, $_POST["email_address"]);
   $phone_number = mysqli_real_escape_string($conn, $_POST["phone_number"]);
   $time_frame = mysqli_real_escape_string($conn, $_POST["time_frame"]);
   $teacher_category = mysqli_real_escape_string($conn, $_POST["teacher_category"]);
   $teacher_estimate = mysqli_real_escape_string($conn, $_POST["teacher_estimate"]);
   $reference_source = mysqli_real_escape_string($conn, $_POST["reference_source"]);

   // Check if the email address already exists
   $checkEmailQuery = "SELECT * FROM school_partners_form WHERE email_address = '$email_address'";
   $result = $conn->query($checkEmailQuery);

   if ($result->num_rows > 0) {
      echo "Error: Email address already exists!";
   } else {
      // Insert data into the table
      $insertQuery = "INSERT INTO school_partners_form 
                       (first_name, middle_name, last_name, school_district, full_address, city, state, country, 
                       email_address, phone_number, time_frame, teacher_category, teacher_estimate, reference_source)
                       VALUES ('$first_name', '$middle_name', '$last_name', '$school_district', '$full_address', '$city', 
                       '$state', '$country', '$email_address', '$phone_number', '$time_frame', '$teacher_category', 
                       '$teacher_estimate', '$reference_source')";

      if ($conn->query($insertQuery) === TRUE) {
         echo "Application submitted successfully!";

         // Update user_type field in the user table
         $updateUserTypeQuery = "UPDATE $user_table SET user_type = 'employer' WHERE $table_key = $user_id";

         if ($conn->query($updateUserTypeQuery) === TRUE) {
            echo "User type updated successfully!";
         } else {
            echo "Error updating user type: " . $updateUserTypeQuery . "<br>" . $conn->error;
         }
      } else {
         echo "Error: " . $insertQuery . "<br>" . $conn->error;
      }
   }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- FontAwesome -->
   <link rel="stylesheet" crossorigin="anonymous" referrerpolicy="no-referrer" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" />
   <!-- FontAwesome -->
   <link rel="stylesheet" href="/Pages/Global/global.css" />
   <link rel="icon" type="image/x-icon" href="/Photos/WMA.png">
   <script defer src="/Pages/Global/global.js"></script>
   <script defer src="school_forms.js"></script>
   <link rel="stylesheet" href="../Study_and_Exchange/study_and_exchange.css">
   <link rel="stylesheet" href="school_forms.css">
   <title>User Profile</title>
</head>

<body>
   <?php require_once "../Study_and_Exchange/navbar.php"; ?>

   <main>
      <div class="main_left">
         <h2>Schools Application Form</h2>
         <p>
            <?php echo $errors; ?>
         </p>

         <h1>Welcome,
            <?php echo $userinfo['first_name']; ?>
         </h1>

         <?php if ($credentialType === 'google_login') : ?>
            <img src="<?php echo $userinfo['picture']; ?>" alt="Profile Picture">
         <?php elseif ($credentialType === 'standard_login') : ?>
            <?php if (!empty($_SESSION["profile_picture"])) : ?>
               <?php $profile_pic = str_replace('../', '', $_SESSION["profile_picture"]); ?>
               <img src="../../../Users/Standard_User/<?php echo $profile_pic; ?>" alt="../../../Users/Standard_User<?php echo $profile_pic; ?>">
            <?php else : ?>
               <!-- Default profile picture or placeholder image if profile picture is not set -->
               <img src="default_profile_picture.jpg" alt="Default Profile Picture">
            <?php endif; ?>
         <?php endif; ?>
      </div>
      <div class="main_right">
         <form name="myForm" method="post" enctype="multipart/form-data">
            <fieldset class="admin_info">
               <legend>Employer Info</legend>

               <label>Full Name <b>*</b></label>
               <div class="fullname_inputs">
                  <input required class="first_name" type="text" id="first_name" name="first_name" placeholder="First Name:">
                  <input class="middle_name" type="text" id="middle_name" name="middle_name" placeholder="Middle Name:">
                  <input required class="last_name" type="text" id="last_name" name="last_name" placeholder="Last Name:">
               </div>

               <label>Schoold District <b>*</b></label>
               <div class="schooldistrict_inputs">
                  <input class="school_district" type="text" id="school_district" name="school_district" placeholder="School District: " required>
               </div>
            </fieldset>

            <fieldset class="address_info">
               <legend>Address and Contact</legend>

               <label>Full Address <b>*</b></label>
               <div class="fulladdress_inputs">
                  <input required class="full_address" type="text" id="full_address" name="full_address" placeholder="Full Address: ">
               </div>

               <label>Address Details <b>*</b></label>
               <div class="address_details">
                  <input required class="city" type="text" id="city" name="city" placeholder="City:">
                  <input required class="state" type="text" id="state" name="state" placeholder="State:">
                  <input required class="country" type="text" id="country" name="country" placeholder="Country:">
               </div>

               <label>Contact Details <b>*</b></label>
               <div class="contact_details">
                  <input required class="email_address" type="email" id="email_address" name="email_address" placeholder="Email Adress:">
                  <input required class="phone_number" type="text" id="phone_number" name="phone_number" placeholder="Phone Number: *include country/city code">
               </div>
            </fieldset>

            <fieldset class="employment_info">
               <legend>Employment Details <b>*</b></legend>
               <div class="employment_details">
                  <select name="time_frame" id="time_frame">
                     <option value="" disabled selected hidden>Choose Timeframe for Needing Educators</option>
                     <option value="Immediate">Immediate</option>
                     <option value="3months">3months</option>
                     <option value="6months">6months</option>
                     <option value="Next School Year">Next School Year</option>
                     <option value="Uncertain">Uncertain</option>
                  </select>

                  <select name="teacher_category" id="teacher_category">
                     <option value="" disabled selected hidden>Category of Teacher</option>
                     <option value="H1-B VISA">H1-B VISA</option>
                     <option value="Uncertain">Uncertain</option>
                  </select>
               </div>

               <div class="other_details">
                  <input class="teacher_estimate" type="number" id="teacher_estimate" name="teacher_estimate" placeholder="Estimated # of Teachers">
                  <input class="reference_source" type="text" id="reference_source" name="reference_source" placeholder="Please specify your source of reference to us: ">
               </div>
            </fieldset>

            <input type="submit" value="Submit Application">
         </form>
      </div>
   </main>

   <!-- FOOTER SECTION -->
   <?php require_once "../Study_and_Exchange/footer.php" ?>
</body>

</html>