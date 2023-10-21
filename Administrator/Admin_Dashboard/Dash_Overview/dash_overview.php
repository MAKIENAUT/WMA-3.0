<?php
require_once "../Dashboard_Scripts/session_segregator.php";
require_once "../../Database/wma_administrator.php";
require_once "../Dashboard_Scripts/j1_visa.php";

function isUserActive()
{
   $timeout = 1800; // 30 minutes in seconds

   if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) < $timeout) {
      return true;
   } else {
      return false;
   }
}

if (!isset($_SESSION['admin_id']) || empty($_SESSION['admin_id'])) {
   header('Location: ../../Admin_Login/admin_login.php');
   exit();
}

$user_id = $_SESSION['admin_id'];
$email_address = $_SESSION['email_address'];
$username = $_SESSION['username'];
$access_credential = $_SESSION['access_credential'];

// Update the last activity timestamp
$_SESSION['last_activity'] = time();
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
   <!-- NAVBAR -->
   <?php require_once "../Dash_Global/dash_navbar.php"; ?>

   <main>
      <div class="main_left">
         <div class="main_title">
            <h1>
               <i class="fa-regular fa-eye"></i> &nbsp; Overview
            </h1>
         </div>

         <div class="applicant_database">
            <?php require_once '../Dash_Global/applicant_cards.php' ?>
         </div>

         <div class="demographic_stats">
            <div class="demographic_navigator">
               <h3>User Demographic</h3>
               <div class="demographic_toolkit">
                  <button class="show_graph" onclick="showGraph()">View Graph</button>
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
                  <div class="user_cards" style="border: 1px solid rgb(0, 133, 133, 0.4);">

                     <img src="<?php echo $user['picture'] ?>" alt="">
                     <p>
                        <?php echo $user['email']; ?>
                     </p>
                     <p>
                        <?php echo $user['full_name']; ?>
                     </p>
                     <p>Google Account</p>
                  </div>
               <?php endforeach; ?>

               <?php foreach ($standard_users as $user): ?>
                  <div class="user_cards" style="border: 1px solid rgb(255, 217, 0, 0.4);">
                     <div class="demographic_picture"
                        style="background-image: url(../../../Users/Standard_User/Standard_Profile/Profile_Pictures/<?php echo $user['email'] ?>/profile_picture.jpg);">
                     </div>
                     <p>
                        <?php echo $user['email']; ?>
                     </p>
                     <p>
                        <?php echo $user['first_name'] . " " . $user["last_name"]; ?>
                     </p>
                     <p>Standard Account</p>
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

      <div class="main_right">
         <div class="admin_profile">
            <h3>Your Profile</h3>
            <div class="admin_profile_body">
               <div class="admin_pfp">
                  <img src="../../Admin_Profile/Profile_Picture/<?php echo $_SESSION['email_address'] . ".jpg"; ?>"
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
            <h3>Administrator Users</h3>
         </div>
      </div>
   </main>
</body>

</html>