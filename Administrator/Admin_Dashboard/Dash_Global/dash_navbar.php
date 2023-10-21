<?php
$current_page = $_SERVER['REQUEST_URI'];
$is_overview_page = strpos($current_page, 'dash_overview.php') !== false;
$is_applicants_page = strpos($current_page, 'dash_applicants.php') !== false;
$is_demographic_page = strpos($current_page, 'dash_demographic.php') !== false;
$is_administrators_page = strpos($current_page, 'dash_administrators.php') !== false;
$is_news_page = strpos($current_page, 'dash_news.php') !== false;
?>

<nav>
   <div class="home_section">
      <a href="../../../Pages/Home/home.php">
         <img src="../../../Photos/wma-logo.png" alt="">
      </a>
   </div>

   <div class="admin_commands">
      <img src="../../Admin_Profile/Profile_Picture/<?php echo $_SESSION['email_address'] . ".jpg"; ?>" alt="">
      <div class="admin_data">
         <h3>
            <?php echo $username ?>
         </h3>
         <p>
            <?php
            $credential = ucwords(str_replace('_', ' ', $access_credential));
            echo $credential;
            ?>
         </p>
      </div>
      <div class="admin_buttons">
         <a href="../../Admin_Logout/admin_logout.php">
            <i class="fa-solid fa-power-off"></i>
         </a>
         <a href="../../Admin_Register/admin_register.php">
            <i class="fa-solid fa-user-plus"></i>
         </a>
         <a href="../../Admin_Profile/profile_settings.php">
            <i class="fa-solid fa-gear"></i>
         </a>
      </div>
   </div>

   <div class="dash_pages">
      <div class="overview_link dash_links <?php echo $is_overview_page ? 'dynamic_style' : ''; ?>" <?php echo $is_overview_page ? 'style="background-color: rgba(255, 255, 255, 0.1);"' : ''; ?>>
         <a href="../../Admin_Dashboard/Dash_Overview/dash_overview.php">
            <i class="fa-regular fa-eye" style="<?php echo $is_overview_page ? 'color: goldenrod;' : ''; ?>"></i>
            <p <?php echo $is_overview_page ? 'style="color: goldenrod;"' : ''; ?>>Overview</p>
         </a>
      </div>
      <div class="applicants_link dash_links <?php echo $is_applicants_page ? 'dynamic_style' : ''; ?>" <?php echo $is_applicants_page ? 'style="background-color: rgba(255, 255, 255, 0.1);"' : ''; ?>>
         <a href="../../Admin_Dashboard/Dash_Applicants/dash_applicants.php">
            <i class="fa-solid fa-users-rectangle"
               style="<?php echo $is_applicants_page ? 'color: goldenrod;' : ''; ?>"></i>
            <p <?php echo $is_applicants_page ? 'style="color: goldenrod;"' : ''; ?>>Applicants</p>
         </a>
      </div>
      <div class="demographic_link dash_links <?php echo $is_demographic_page ? 'dynamic_style' : ''; ?>" <?php echo $is_demographic_page ? 'style="background-color: rgba(255, 255, 255, 0.1);"' : ''; ?>>
         <a href="../../Admin_Dashboard/Dash_Demographic/dash_demographic.php">
            <i class="fa-solid fa-user-plus" style="<?php echo $is_demographic_page ? 'color: goldenrod;' : ''; ?>"></i>
            <p <?php echo $is_demographic_page ? 'style="color: goldenrod;"' : ''; ?>>Demographic</p>
         </a>
      </div>
      <div class="administrator_link dash_links <?php echo $is_administrators_page ? 'dynamic_style' : ''; ?>" <?php echo $is_administrators_page ? 'style="background-color: rgba(255, 255, 255, 0.1);"' : ''; ?>>
         <a href="../../Admin_Dashboard/Dash_Administrators/dash_administrators.php">
            <i class="fa-solid fa-user-lock"
               style="<?php echo $is_administrators_page ? 'color: goldenrod;' : ''; ?>"></i>
            <p <?php echo $is_administrators_page ? 'style="color: goldenrod;"' : ''; ?>>Administrators</p>
         </a>
      </div>
      <div class="administrator_link dash_links <?php echo $is_news_page ? 'dynamic_style' : ''; ?>" <?php echo $is_news_page ? 'style="background-color: rgba(255, 255, 255, 0.1);"' : ''; ?>>
         <a href="../../Admin_Dashboard/Dash_Administrators/dash_administrators.php">
            <i class="fa-regular fa-newspaper" style="<?php echo $is_news_page ? 'color: goldenrod;' : ''; ?>"></i>
            <p <?php echo $is_news_page ? 'style="color: goldenrod;"' : ''; ?>>News and Content</p>
         </a>
      </div>
   </div>
   <p>Copyright 2023</p>
</nav>