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
   <title>Overview</title>
</head>

<body onload="updateTimer()">
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
            <h3>Your Profile <span id="timer">hi</span>
               <!-- <script>
                  let timerElement = document.getElementById('timer');
                  let timerInterval;
                  let timerDuration = 30 * 60; // 2 minutes in seconds

                  function updateTimer() {
                     let minutes = Math.floor(timerDuration / 60);
                     let seconds = timerDuration % 60;
                     timerElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                  }

                  function startTimer() {
                     timerInterval = setInterval(function () {
                        timerDuration--;
                        if (timerDuration <= 0) {
                           clearInterval(timerInterval);
                           timerElement.textContent = 'Time\'s up!';
                           window.location.href = '../../Admin_Commands/admin_logout.php';
                        } else {
                           updateTimer();
                        }
                     }, 1000);
                  }

                  function restartTimer() {
                     clearInterval(timerInterval);
                     timerDuration = 30 * 60;
                     startTimer();
                  }

                  startTimer();

                  document.addEventListener('mousemove', restartTimer);
               </script> -->
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
            News/Post Statistic
         </div>
         <div class="admin_stats">
            <?php require_once "../../Admin_Components/administrators_display.php"; ?>
         </div>
      </div>
   </main>
</body>

</html>