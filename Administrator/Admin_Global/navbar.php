<?php

$current_page = $_SERVER['REQUEST_URI'];
$is_overview_page = strpos($current_page, 'overview.php') !== false;
$is_applicants_page = strpos($current_page, 'applicants.php') !== false;
$is_demographic_page = strpos($current_page, 'demographics.php') !== false;
$is_administrators_page = strpos($current_page, 'administrators.php') !== false;
$is_news_page = strpos($current_page, 'content_creator.php') !== false;
$is_news_page = strpos($current_page, 'news_and_content.php') !== false;
$is_file_manager_page = strpos($current_page, 'file_manager.php') !== false; // Added this line

?>

<nav>
   <div class="home_section">
      <a href="../../../Pages/Home/home.php">
         <img src="../../../Photos/wma-logo.png" alt="">
      </a>
   </div>

   <div class="admin_commands">
      <div class="nav_pfp"
         style="background-image:url(../../Admin_Profile/Profile_Picture/<?php echo $admin_email . ".jpg"; ?>);"
         alt="">
      </div>
      <div class="admin_data">
         <h3>
            <?php echo $admin_username ?>
         </h3>
         <p>
            <?php
            $credential = ucwords(str_replace('_', ' ', $access_credential));
            echo $credential;
            ?>
         </p>
      </div>
      <div class="admin_buttons">
         <a href="#" onclick="confirmLogout()">
            <i class="fa-solid fa-power-off"></i>
         </a>
         <script>
            function confirmLogout() {
               var confirmLogout = confirm("Are you sure you want to logout?");
               if (confirmLogout) {
                  window.location.href = '../../Admin_Commands/admin_logout.php';
               }
            }
         </script>

         <a href="../../Admin_Commands/admin_register.php">
            <i class="fa-solid fa-user-plus"></i>
         </a>
         <a href="../../Admin_Commands/admin_settings.php">
            <i class="fa-solid fa-gear"></i>
         </a>
      </div>
   </div>

   <div class="dash_pages">
      <div class="overview_link dash_links <?php echo $is_overview_page ? 'dynamic_style' : ''; ?>" <?php echo $is_overview_page ? 'style="background-color: rgba(255, 255, 255, 0.1);"' : ''; ?>>
         <a href="../../Admin_Dashboard/Overview/overview.php">
            <i class="fa-regular fa-eye" style="<?php echo $is_overview_page ? 'color: goldenrod;' : ''; ?>"></i>
            <p <?php echo $is_overview_page ? 'style="color: goldenrod;"' : ''; ?>>Overview</p>
         </a>
      </div>
      <div
         class="applicants_link dash_links <?php echo ($is_applicants_page || $is_file_manager_page) ? 'dynamic_style' : ''; ?>"
         <?php echo ($is_applicants_page || $is_file_manager_page) ? 'style="background-color: rgba(255, 255, 255, 0.1);"' : ''; ?>>
         <a href="../../Admin_Dashboard/Applicants/applicants.php">
            <i class="fa-solid fa-users-rectangle"
               style="<?php echo ($is_applicants_page || $is_file_manager_page) ? 'color: goldenrod;' : ''; ?>"></i>
            <p <?php echo ($is_applicants_page || $is_file_manager_page) ? 'style="color: goldenrod;"' : ''; ?>>
               Applicants</p>
         </a>
      </div>
      <div class="demographic_link dash_links <?php echo $is_demographic_page ? 'dynamic_style' : ''; ?>" <?php echo $is_demographic_page ? 'style="background-color: rgba(255, 255, 255, 0.1);"' : ''; ?>>
         <a href="../../Admin_Dashboard/Demographics/demographics.php">
            <i class="fa-solid fa-user-plus" style="<?php echo $is_demographic_page ? 'color: goldenrod;' : ''; ?>"></i>
            <p <?php echo $is_demographic_page ? 'style="color: goldenrod;"' : ''; ?>>Demographics</p>
         </a>
      </div>
      <div class="administrator_link dash_links <?php echo $is_administrators_page ? 'dynamic_style' : ''; ?>" <?php echo $is_administrators_page ? 'style="background-color: rgba(255, 255, 255, 0.1);"' : ''; ?>>
         <a href="../../Admin_Dashboard/Administrators/administrators.php">
            <i class="fa-solid fa-user-lock"
               style="<?php echo $is_administrators_page ? 'color: goldenrod;' : ''; ?>"></i>
            <p <?php echo $is_administrators_page ? 'style="color: goldenrod;"' : ''; ?>>Administrators</p>
         </a>
      </div>
      <div class="administrator_link dash_links <?php echo $is_news_page ? 'dynamic_style' : ''; ?>" <?php echo $is_news_page ? 'style="background-color: rgba(255, 255, 255, 0.1);"' : ''; ?>>
         <a href="../../Admin_Dashboard/News_And_Content/news_and_content.php">
            <i class="fa-regular fa-newspaper" style="<?php echo $is_news_page ? 'color: goldenrod;' : ''; ?>"></i>
            <p <?php echo $is_news_page ? 'style="color: goldenrod;"' : ''; ?>>News and Content</p>
         </a>
      </div>
   </div>
   <p>Copyright 2023</p>
</nav>