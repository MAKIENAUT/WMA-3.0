<?php
// IMPORT DATABASES
require_once "../../Database/wma_administrator.php";
require_once "../Dashboard_Scripts/j1_visa.php";

if (isset($_SESSION["id"]) && !empty($_SESSION["id"])) {
   header('Location: ../../Admin_Login/admin_login.php');
   exit(); // Make sure to exit after a header redirect
}

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
   <title>Overview</title>
</head>

<body>
   <nav>
      <div class="home_section">
         <a href="../../../Pages/Home/home.php">
            <img src="../../../Photos/wma-logo.png" alt="">
         </a>
      </div>

      <div class="dash_pages">

      </div>
   </nav>

   <main>
      <div class="main_left">
         <div class="main_title">
            <h1>
               Overview
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
                        require_once "../Dashboard_Scripts/wma_users_google.php";

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
               User Demographic Statistic
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