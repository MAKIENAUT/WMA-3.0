<?php
require_once "../../Admin_Global/page_initiators.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <link rel="stylesheet" href="../Overview/overview.css">
   <link rel="stylesheet" href="../../Admin_Global/global.css">
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

      .applicant_card {
         height: 75%;
      }
   </style>
</head>

<body onload="navbar_setting()">

   <?php require_once "../../Admin_Global/navbar.php"; ?>

   
   <main>
      <div class="main_left">
         <div class="main_title">
            <h1>
               <i class="fa-solid fa-users-rectangle"></i> &nbsp; Applicant Database
            </h1>
         </div>

         <div class="applicant_database">
            <?php require_once '../../Admin_Components/applicants_display.php' ?>
         </div>
      </div>

   </main>
</body>

</html>