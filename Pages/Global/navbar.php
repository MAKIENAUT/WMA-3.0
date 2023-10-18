<?php
require_once "../../Administrator/Admin_Dashboard/Dashboard_Scripts/wma_users_tables.php";

session_start();
foreach ($google_users as $user):
   ?>
   <div class="user_cards">

      <img src="<?php echo $user['picture'] ?>" alt="">
      <p>
         <?php echo $user['email']; ?>
      </p>
      <p>
         <?php echo $user['full_name']; ?>
      </p>
      <p>Google Login</p>
   </div>
   <?php
endforeach;

foreach ($standard_users as $user):
   ?>
   <div class="user_cards">
      <div class="demographic_picture"
         style="background-image: url(../../../Users/Standard_User/Standard_Profile/Profile_Pictures/<?php echo $user['email'] ?>/profile_picture.jpg);">
      </div>
      <p>
         <?php echo $user['email']; ?>
      </p>
      <p>
         <?php echo $user['first_name'] . " " . $user["last_name"]; ?>
      </p>
      <p>Standard User</p>
   </div>
   <?php
endforeach;
?>


<nav class="navbar-parent">
   <div class="navbar-container">
      <div class="navbar-main-container">
         <a class="navbar-logo" href="/Pages/Home/home.php">
            <img src="/Photos/wma-logo.png" alt="WMA Logo" />
         </a>
         <button id="navbarMobileIcon" class="navbar-mobile-icon fa fa-bars burger-icon" onclick="toggleNavbar()">
         </button>
      </div>
      <div id="navbarLinkContainer" class="navbar-link-container">
         <a class="navbar-link" href="#">News</a>
         <div class="navbar-category-container" href="javascript:void(0)">
            <p id="navbarCategoryContainer" onclick="toggleCategory()">Process<i class="fa-solid fa-caret-down"></i>
            </p>
            <div id="navbarCategory" class="navbar-category">
               <a class="navbar-category-link" href="/Pages/Process/family-based.php">Family Based</a>
               <a class="navbar-category-link" href="/Pages/Process/study-and-exchange.php">Study and Exchange</a>
               <a class="navbar-category-link" href="/Pages/Process/temporary-employment.php">Temporary
                  Employment</a>
            </div>
         </div>
         <div class="navbar-category-container" href="javascript:void(0)">
            <p id="navbarCategoryContainer2" onclick="toggleCategory2()">Categories<i
                  class="fa-solid fa-caret-down"></i></p>
            <div id="navbarCategory2" class="navbar-category">
               <a class="navbar-category-link" href="#">Family Based</a>
               <a class="navbar-category-link" href="#">Study and Exchange (J-1)</a>
               <a class="navbar-category-link" href="#">Temporary Employment (EB-3/H2A)</a>
            </div>
         </div>
         <a class="navbar-link" href="/Pages/About-us/about.php">About Us</a>
         <?php if (isset($_SESSION["id"]) && !empty($_SESSION["id"])): ?>
            <img src="<?php echo $userinfo['picture']; ?>" alt="Profile Picture">
         <?php elseif ($credentialType === 'standard_login'): ?>
            <?php if (!empty($_SESSION["profile_picture"])): ?>
               <?php $profile_pic = str_replace('../', '', $_SESSION["profile_picture"]); ?>
               <img src="../../../Users/Standard_User/<?php echo $profile_pic; ?>"
                  alt="../../../Users/Standard_User<?php echo $profile_pic; ?>">
            <?php else: ?>
               <!-- Default profile picture or placeholder image if profile picture is not set -->
               <a class="navbar-link" href="#">Login/Sign up</a>

            <?php endif; ?>
         <?php endif; ?>
      </div>
   </div>
</nav>

if (isset($_SESSION["id"]) && !empty($_SESSION["id"])) {
   header("location: ../../../Pages/Home/home.php");
   exit;
}