<?php

require_once "../Dashboard_Scripts/session_segregator.php";
require_once "../Dashboard_Scripts/j1_visa.php";

if (!isset($_SESSION['admin_id']) && empty($_SESSION['admin_id'])) {
   header('Location: ../../Admin_Login/admin_login.php');
   exit(); // Make sure to exit after a header redirect
}
// Fetch session variables
$user_id = $_SESSION['admin_id'];
$email_address = $_SESSION['email_address'];
$username = $_SESSION['username'];
$access_credential = $_SESSION['access_credential'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <script src="dash_applicants.js"></script>
   <link rel="stylesheet" href="../Dash_Overview/dash_overview.css">
   <link rel="stylesheet" href="../Dash_Global/dash_global.css">
   <link rel="stylesheet" href="../../../Pages/Global/global.css" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
   <title>Applicant Database</title>

   <style>
      .main_left {
         width: 100%;
         height: 100%;
      }
      .applicant_navigator h3 {
         font-size: 1.5rem;
      }

      .applicant_database {
         height: 100%;
      }
      .applicant_database h3 {
         display: none;
      }
      .applicant_card {
         height: 75%;
      }

      .admin_cards {
         width: 24%;
         padding: 5px;
         height: 375px;
         gap: 0;
      }

      .admin_username {
         display: flex;
         font-size: 1.2rem;
      }

      .admin_email {
         display: flex;
         font-size: 0.9rem;
      }

      .admin_email,
      .last_login,
      .last_logout {
         display: flex;
         font-size: 0.9rem;
      }
   </style>
</head>

<body onload="navbar_setting()">

   <?php require_once "../Dash_Global/dash_navbar.php"; ?>


   <main>
      <div class="main_left">
         <div class="main_title">
            <h1>
               <i class="fa-solid fa-users-rectangle"></i> &nbsp; Administrator Users
            </h1>
         </div>

         <div class="applicant_database">
            <?php require_once '../Dash_Global/admin_users.php' ?>
         </div>
      </div>

   </main>
</body>

</html>