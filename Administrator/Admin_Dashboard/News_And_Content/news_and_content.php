<?php
require_once("../../Admin_Global/page_initiators.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <script src="news_and_content.js"></script>
   <link rel="stylesheet" href="news_and_content.css">
   <link rel="stylesheet" href="../../Admin_Global/global.css">
   <link rel="stylesheet" href="../../../Pages/Global/global.css" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <link rel="icon" type="image/x-icon" href="../../../Photos/WMA.png">
   <title>News and Content</title>
</head>

<body>
   <!-- NAVBAR -->
   <?php require_once "../../Admin_Global/navbar.php"; ?>

   <main>
      <div class="main_left">
         <div class="main_title">
            <h1>
               <i class="fa-regular fa-newspaper"></i> &nbsp; News And Content
            </h1>

            <h2>
               <a href="content_creator.php" title="Add Content">
                  <i class="fa-solid fa-plus"></i>
               </a>
            </h2>
         </div>

         <?php require_once "../../Admin_Components/content_display.php"; ?>
      </div>

      <div class="main_right">
         <div class="post_stat_header">
            <h2><i class="fa-solid fa-gauge"></i> &nbsp; Content Statistics</h2>
            <button id="chart_toggle" onclick="toggleChartType()">
               <i class="fa-solid fa-chart-simple"></i>
            </button>
         </div>

         <?php require_once "../../Admin_Components/content_statistics.php"; ?>
      </div>
   </main>
</body>

</html>