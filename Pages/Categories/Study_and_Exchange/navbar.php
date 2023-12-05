<?php
$credentialType = null; // Initialize $credentialType
$result = null; // Initialize $result

if (isset($_SESSION['user_token'])) {
   $credentialType = 'google_login';
   $sql = $conn->prepare("SELECT * FROM wma_users_google WHERE token = ?");
   $sql->bind_param("s", $_SESSION['user_token']);
   $sql->execute();
   $result = $sql->get_result();
} elseif (isset($_SESSION['id'])) {
   $credentialType = 'standard_login';
   $sql = $conn->prepare("SELECT * FROM wma_users_standard WHERE id = ?");
   $sql->bind_param("i", $_SESSION['id']);
   $sql->execute();
   $result = $sql->get_result();
}

if ($result !== null && $result->num_rows > 0) {
   $userinfo = $result->fetch_assoc();
}
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
         <a class="navbar-link" href="/Pages/News/news.php">News/Blog</a>
         <a class="navbar-link" href="/Pages/About-us/about.php">About Us</a>
         <div class="navbar-category-container" href="javascript:void(0)">
            <p id="navbarCategoryContainer" onclick="toggleCategory()">Process<i class="fa-solid fa-caret-down"></i>
            </p>
            <div id="navbarCategory" class="navbar-category">
               <a class="navbar-category-link" href="/Pages/Process/family-based.php">Family Based</a>
               <a class="navbar-category-link" href="/Pages/Process/study-and-exchange.php">Study and Exchange</a>
               <a class="navbar-category-link" href="/Pages/Process/temporary-employment.php">Temporary Employment</a>
            </div>
         </div>

         <div class="navbar-category-container" href="javascript:void(0)">
            <p id="navbarCategoryContainer2" onclick="toggleCategory2()">Applicants<i class="fa-solid fa-caret-down"></i></p>
            <div id="navbarCategory2" class="navbar-category">
               <a class="navbar-category-link" href="/Pages/Categories/Family_Based/family_based.php">Family Based</a>
               <a class="navbar-category-link" href="/Pages/Categories/Study_and_Exchange/study_and_exchange.php">Study
                  and Exchange (J-1)</a>
               <a class="navbar-category-link" href="/Pages/Categories/Temporary_Employment/temporary_employment.php">Temporary Employment
                  (EB-3/H2A)</a>
            </div>
         </div>
         /
         <a class="navbar-link" href="/Pages/Categories/Partnership/school_forms.php">Partnership</a>

         <?php
         if (isset($_SESSION['user_token'])) {
            // Use $userinfo['picture'] directly, as it's already fetched above
            $google_pfp = $userinfo['picture'];
         ?>
            <a href="#" class="navbar-link profile-holder">
               <div class="profile" style="background-image: url(<?php echo $google_pfp ?>);"></div>
               <?php echo $userinfo['first_name']; ?>
               <div onclick="confirmLogout()" class="logout">
                  <div onclick="confirmLogout()" class="logout"><i class="fa-solid fa-power-off"></i></div>
               </div>
            </a>

            <script>
               function confirmLogout() {
                  var confirmLogout = confirm("Are you sure you want to logout?");
                  if (confirmLogout) {
                     window.location.href = '../../Users/User_Login_Google/logout.php';
                  }
               }
            </script>

         <?php
         } elseif (isset($_SESSION['id'])) {
            $pfp = $userinfo['profile_picture'];
         ?>
            <a href="#" class="navbar-link profile-holder">
               <div class="profile" style="background-image: url(../../Users/Standard_User/<?php echo substr($pfp, 3) ?>);"></div>
               <?php echo $userinfo['first_name']; ?>
               <div onclick="confirmLogout()" class="logout"><i class="fa-solid fa-power-off"></i></div>
            </a>
            <script>
               function confirmLogout() {
                  var confirmLogout = confirm("Are you sure you want to logout?");
                  if (confirmLogout) {
                     window.location.href = '../../Users/User_Login_Google/logout.php';
                  }
               }
            </script>
         <?php
         }
         ?>
      </div>
   </div>
</nav>