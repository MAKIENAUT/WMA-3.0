<?php
   require_once "../../Admin_Global/page_initiators.php";
   require_once "../../Admin_Global/fetch_demographics.php";
?>


<div class="demographic_navigator">
   <h3>User Demographic</h3>
   <div class="demographic_toolkit">
      <button class="show_graph" onclick="showGraph()">View Graph</button>
      <div class="search_bar">
         <input type="text" id="userSearch" name="searchbar" placeholder="🔎 Search" onkeyup="searchUsers()">
      </div>
   </div>
</div>
<div class="user_card_container">
   <?php
   foreach ($google_users as $user): ?>
      <div class="user_cards" style="border: 1px solid rgb(0, 133, 133, 0.4);">

         <img src="<?php echo $user['picture'] ?>" alt="">
         <p>
            <b>
               <?php echo $user['full_name']; ?>
            </b>
         </p>
         <p>
            <?php echo $user['email']; ?>
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
            <b>
               <?php echo $user['first_name'] . " " . $user["last_name"]; ?>
            </b>
         </p>
         <p>
            <?php echo $user['email']; ?>
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
   function showGraph() {
      var graphContainer = document.getElementById('chart_div');
      var cardContainer = document.querySelector('.user_card_container');
      var showGraph_Button = document.querySelector('.show_graph');

      var isGraphHidden = graphContainer.style.display === 'none';

      graphContainer.style.display = isGraphHidden ? 'flex' : 'none';
      cardContainer.style.display = isGraphHidden ? 'none' : 'flex';
      showGraph_Button.style.color = isGraphHidden ? 'gold' : 'white';
      showGraph_Button.innerHTML = isGraphHidden ? 'View Cards' : 'View Graph';
      showGraph_Button.style.border = isGraphHidden ? '1px solid teal' : '1px solid rgba(149, 149, 149, 0.8)';
   }
</script>