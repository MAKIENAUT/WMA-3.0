<?php
// IMPORT DATABASES
require_once "../../Database/wma_administrator.php";

require_once "../Dashboard_Scripts/applicant_database.php";

if (isset($_SESSION["id"]) && !empty($_SESSION["id"])) {
   header('Location: ../../Admin_Login/admin_login.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <script src="dash_overview.js"></script>
   <link rel="stylesheet" href="dash_overview.css">
   <link rel="stylesheet" href="../Dash_Global/dash_global.css">
   <link rel="stylesheet" href="../../../Pages/Global/global.css" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Overview</title>
</head>

<body>
   <nav>
      <div class="home_section">
         <a href="../../../Pages/Home/home.php">
            <img src="../../../Photos/wma-logo.png" alt="">
         </a>
      </div>

      <div class="dash_pages">

      </div>
   </nav>

   <main>
      <div class="main_left">
         <div class="main_title">
            <h1>
               Overview
            </h1>
         </div>

         <div class="applicant_database">
            <div class="applicant_navigator">
               <h3>Applicants</h3>
               <div class="toolkit">
                  <div class="search_bar">
                     <input 
                        type="text" 
                        id="searchbar" 
                        name="searchbar" 
                        placeholder="🔎 Search" 
                        oninput="applicant_search()">
                  </div>
               </div>
            </div>
            <div class="applicant_card_container">
               <?php
               foreach ($applicants as $applicant) {
                  $id = $applicant['id'];
                  $first_name = $applicant['first_name'];
                  $last_name = $applicant['last_name'];
                  $email_address = $applicant['email_address'];
                  $profession = $applicant['profession'];
                  $date_submitted = $applicant['date_submitted'];
                  $file = $applicant['file'];
                  ?>
                  <div class="applicant_card"
                     data-search="<?php echo strtolower($first_name . ' ' . $last_name . ' ' . $email_address . ' ' . $profession); ?>">
                     <div class="applicant_picture"
                        style="background-image: url(../../../Users/Standard_User/Standard_Profile/Profile_Pictures/<?php echo $email_address ?>/profile_picture.jpg);">
                        <div class="applicant_nameplate">
                           <p><b>
                                 <?php echo $last_name; ?>
                              </b>,
                              <?php echo $first_name; ?>
                           </p>
                        </div>
                     </div>
                     <div class="other_details">
                        <p>
                           <?php echo $profession; ?>
                        </p>
                        <p>
                           <?php echo $date_submitted; ?>
                        </p>
                     </div>
                     <p class="email_address">
                        <?php echo $email_address; ?>
                     </p>
                  </div>
                  <?php
               }
               ?>
            </div>
         </div>

         <div class="demographic_stats">
            User Demographic Statistic
         </div>
      </div>

      <div class="main_right">
         <div class="post_stats">
            News/Post Statistic
         </div>
         <div class="admin_profile">
            Administrator Profile
         </div>
         <div class="admin_stats">
            Admin Account Status
         </div>
      </div>
   </main>
</body>

</html>