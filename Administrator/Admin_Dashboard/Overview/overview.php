<?php
require_once("../../Admin_Global/page_initiators.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <script src="overview.js"></script>
   <link rel="stylesheet" href="overview.css">
   <link rel="stylesheet" href="../../Admin_Global/global.css">
   <link rel="stylesheet" href="../../../Pages/Global/global.css" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />

   <link rel="icon" type="image/x-icon" href="../../../Photos/WMA.png">
   <title>Overview</title>
</head>

<body>
   <!-- NAVBAR -->
   <?php require_once "../../Admin_Global/navbar.php"; ?>

   <main>
      <div class="main_left">
         <div class="main_title">
            <h1>
               <i class="fa-regular fa-eye"></i> &nbsp; Overview
            </h1>
         </div>

         <div class="applicant_database">
            <?php require_once "../../Admin_Components/applicants_display.php"; ?>
         </div>

         <div class="demographic_stats">
            <?php require_once "../../Admin_Components/demographics_display.php" ?>
         </div>
      </div>
      <div class="main_right">
         <div class="admin_profile">
            <h3>Your Profile <span id="timer" onmouseover="restartTimer()"></span>
               <script src="timer.js"></script>
            </h3>

            <div class="admin_profile_body">
               <div class="admin_pfp"
                  style="background-image:url(../../Admin_Profile/Profile_Picture/<?php echo $_SESSION['email_address'] . ".jpg"; ?>);"
                  alt="">
               </div>
               <div class="admin_info">
                  <h3>
                     <?php echo $_SESSION['username']; ?>&nbsp; ✨
                  </h3>

                  <p>
                     <?php echo $_SESSION['email_address']; ?>
                  </p>
                  <p>
                     <?php echo $credential; ?>
                  </p>
                  <p>Status: <b>Active</b></p>
                  <p>Password Expires in: 00/00/00</p>
               </div>
            </div>
         </div>

         <div class="post_stats">
            <div class="post_stat_header">
               <h3>News/Post Statistic</h3>
               <button id="chart_toggle" onclick="toggleChartType()">
                  <i class="fa-solid fa-chart-pie"></i>
               </button>
            </div>

            <?php
            require_once "../../Admin_Components/content_statistics.php";
            ?>

         </div>
         <div class="admin_stats">
            <?php require_once "../../Admin_Components/administrators_display.php"; ?>
         </div>
      </div>
   </main>
</body>

</html>