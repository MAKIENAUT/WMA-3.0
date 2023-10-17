<?php
// IMPORT DATABASES
require_once "../../Database/wma_administrator.php";
require_once "../Dashboard_Scripts/j1_visa.php";

if (isset($user_id) && !empty($user_id)) {
   header('Location: ../../Admin_Login/admin_login.php');
   exit(); // Make sure to exit after a header redirect
}
session_start();

// Fetch session variables
$user_id = $_SESSION['id'];
$email_address = $_SESSION['email_address'];
$username = $_SESSION['username'];
$access_credential = $_SESSION['access_credential'];

// Pagination Variables
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$cardsPerPage = 20;
$start = ($page - 1) * $cardsPerPage;
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
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
   <title>Overview</title>


</head>

<body>
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
         <div class="overview_link dash_links" style="background-color: rgba(255, 255, 255, 0.1);">
            <a href="../../Admin_Dashboard/Dash_Overview/dash_overview.php">
               <i class="fa-regular fa-eye" style="color: goldenrod;"></i>
               <p style="color: goldenrod;">Overview</p>
            </a>
         </div>
         <div class="applicants_link dash_links">
            <a href="../../Admin_Dashboard/Dash_Applicants/dash_applicants.php">
               <i class="fa-solid fa-users-rectangle"></i>
               <p>Applicants</p>
            </a>
         </div>
         <div class="demographic_link dash_links">
            <a href="../../Admin_Dashboard/Dash_Demographic/dash_demographic.php">
               <i class="fa-solid fa-user-plus"></i>
               <p>Demographic</p>
            </a>
         </div>
         <div class="administrator_link dash_links">
            <a href="../../Admin_Dashboard/Dash_Administrators/dash_administrators.php">
               <i class="fa-solid fa-user-lock"></i>
               <p>Administrators</p>
            </a>
         </div>
      </div>
      <p>Copyright 2023</p>
   </nav>

   <main>
      <div class="main_left">
         <div class="main_title">
            <h1>
               <i class="fa-regular fa-eye"></i> &nbsp; Overview
            </h1>
         </div>

         <div class="applicant_database">
            <div class="applicant_navigator">
               <h3>Applicants</h3>
               <div class="toolkit">
                  <div class="pagination">
                     Page:

                     <?php
                     $totalCards = count($applicants);
                     $totalPages = ceil($totalCards / $cardsPerPage);

                     // Show "Previous" button if not on the first page
                     if ($page > 1) {
                        echo "<a href='?page=" . ($page - 1) . "'>Previous</a>";
                     }

                     for ($i = 1; $i <= $totalPages; $i++) {
                        $activeClass = ($i == $page) ? 'active' : '';
                        echo "<a href='?page=$i' class='$activeClass'>$i</a>";
                     }

                     // Show "Next" button if not on the last page
                     if ($page < $totalPages) {
                        echo "<a href='?page=" . ($page + 1) . "'>Next</a>";
                     }
                     ?>
                  </div>


                  <div class="search_bar">
                     <input type="text" id="searchbar" name="searchbar" placeholder="🔎 Search"
                        oninput="applicant_search()">
                  </div>
               </div>
            </div>
            <div class="applicant_card_container">
               <?php

               // Use array_slice to get the subset of applicants for the current page
               foreach (array_slice($applicants, $start, $cardsPerPage) as $applicant) {
                  $id = $applicant['id'];
                  $first_name = $applicant['first_name'];
                  $last_name = $applicant['last_name'];
                  $email_address = $applicant['email_address'];
                  $profession = $applicant['profession'];
                  $date_submitted = $applicant['date_submitted'];
                  $file = $applicant['file'];
                  $login_method = $applicant['login_method'];
                  ?>
                  <div class="applicant_card"
                     data-search="<?php echo strtolower($first_name . ' ' . $last_name . ' ' . $email_address . ' ' . $profession); ?>">
                     <?php
                     if ($login_method === "google_login") {
                        require_once "../Dashboard_Scripts/wma_users_tables.php";

                        foreach ($google_users as $google_user) {
                           $profile_picture = $google_user['picture'];
                        }

                        ?>
                        <div class="applicant_picture" style="background-image: url(<?php echo $profile_picture; ?>);">
                           <?php

                     } elseif ($login_method === "standard_login") {

                        ?>
                           <div class="applicant_picture"
                              style="background-image: url(../../../Users/Standard_User/Standard_Profile/Profile_Pictures/<?php echo $email_address ?>/profile_picture.jpg);">
                              <?php
                     }
                     ?>

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
                           <a href="">
                              <?php echo $email_address; ?>
                           </a>
                        </p>
                     </div>
                     <?php
               }
               ?>
               </div>
            </div>

            <div class="demographic_stats">
               <div class="demographic_navigator">
                  <h3>User Demographic</h3>
                  <div class="demographic_toolkit">
                     <button onclick="showGraph()">Toggle View</button>
                     <div class="search_bar">
                     <input type="text" id="userSearch" name="searchbar" placeholder="🔎 Search"
                        onkeyup="searchUsers()">
                  </div>
                  </div>
               </div>
               <div class="user_card_container">
                  <?php
                  require_once "../Dashboard_Scripts/wma_users_tables.php";
                  foreach ($google_users as $user): ?>
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
                  <?php endforeach; ?>

                  <?php foreach ($standard_users as $user): ?>
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
                  <?php endforeach; ?>
               </div>
               <div id="chart_div" style="display: none;"></div>
               <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
               <script type="text/javascript">
                  google.charts.load('current', { 'packages': ['corechart'] });
                  google.charts.setOnLoadCallback(drawChart);

                  function drawChart() {
                     // Assuming you have an array called userStats with the required data
                     var data = google.visualization.arrayToDataTable([
                        ['User Type', 'Count'],
                        ['Google Login', <?php echo count($google_users); ?>],
                        ['Standard User', <?php echo count($standard_users); ?>]
                     ]);

                     var options = {
                        title: 'User Demographic Stats',
                        pieHole: 0.4, // Makes it a donut chart
                        backgroundColor: 'transparent', // Set background color to transparent
                        legend: { textStyle: { color: 'white' } }, // Set legend text color to white
                        titleTextStyle: { color: 'white' }, // Set title text color to white
                        slices: {
                           0: { color: 'teal' }, // Google Login
                           1: { color: 'gold' }  // Standard User
                        }
                        
                     };

                     var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                     chart.draw(data, options);
                  }
               </script>
            </div>
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