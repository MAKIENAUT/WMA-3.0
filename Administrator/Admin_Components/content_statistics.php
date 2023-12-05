<?php
require_once "../../Admin_Global/page_initiators.php";
require_once "../../Admin_Global/fetch_applicants.php";

$servername = "localhost";
$username = "root";
$password = "";
$database = "wma";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

$content_sql = "SELECT c.*,
COUNT(DISTINCT us.content_id) as standard_like_count,
COUNT(DISTINCT ug.content_id) as google_like_count
FROM wma_content c
LEFT JOIN wma_standard_content us ON c.id = us.content_id
LEFT JOIN wma_google_content ug ON c.id = ug.content_id
GROUP BY c.id";

$display_stat = $conn->query($content_sql);

// Initialize arrays
$post_category = 0;
$news_category = 0;
$public_status = 0;
$private_status = 0;

// Initialize array for post likes
$postLikesColumn = [];
$postLikesDonut = [];
$shareCountDonut = [];

while ($row = $display_stat->fetch_assoc()) {
   $title = $row['title'];
   $content_id = $row['id'];
   $category = $row['category'];
   $post_status = $row['post_status'];
   $share_count = $row['share_count'];

   // Counting likes using SQL queries is not optimal. Consider optimizing this part.

   if ($category == 'post') {
      $post_category++;
   } elseif ($category == 'news') {
      $news_category++;
   }

   if ($post_status == 'featured') {
      $public_status++;
   } elseif ($post_status == 'public') {
      $private_status++;
   } elseif ($post_status == 'private') {
      $private_status++;
   }

   // Store data for the new chart
   $slc = $conn->query("SELECT COUNT(*) FROM wma_standard_content WHERE content_id = $content_id")->fetch_assoc()["COUNT(*)"];
   $glc = $conn->query("SELECT COUNT(*) FROM wma_google_content WHERE content_id = $content_id")->fetch_assoc()["COUNT(*)"];
   $total_like_count = $slc + $glc;

   $shareCountDonut[$title] = $share_count;
   $postLikesColumn[$title] = $total_like_count;
   $postLikesDonut[$content_id] = $total_like_count;
}
?>

<div class="graph_container">
   <div id="likesChart" style="width: 100%; height: 30%;">  </div>
   <div id="shareChart" style="width: 100%; height: 30%;"></div>
   <div id="statusChart" style="width: 100%; height: 30%;"></div>
   <div id="categoryChart" style="width: 100%; height: 30%;"></div>
</div>

<script type="text/javascript">
   google.charts.load('current', {
      'packages': ['corechart']
   });
   google.charts.setOnLoadCallback(drawCategoryChart);
   google.charts.setOnLoadCallback(drawStatusChart);
   google.charts.setOnLoadCallback(drawShareChart);
   google.charts.setOnLoadCallback(drawLikesColumnChart); // Initial chart type is column

   // Variable to track the current chart type
   var currentChartType = 'column';

   function drawCategoryChart() {
      var data = google.visualization.arrayToDataTable([
         ['Content Category', 'Count'],
         ['Post', <?php echo $post_category; ?>],
         ['News', <?php echo $news_category; ?>]
      ]);

      var options = getChartOptions('Content Category');

      var chart = new google.visualization.PieChart(document.getElementById('categoryChart'));
      chart.draw(data, options);
   }

   function drawStatusChart() {
      var data = google.visualization.arrayToDataTable([
         ['Content Status', 'Count'],
         ['Featured', <?php echo $public_status; ?>],
         ['Public', <?php echo $private_status; ?>],
         ['Private', <?php echo $private_status; ?>]
      ]);

      var options = getChartOptions('Content Status');

      var chart = new google.visualization.PieChart(document.getElementById('statusChart'));
      chart.draw(data, options);
   }

   function drawLikesChart() {
      if (currentChartType === 'column') {
         drawLikesColumnChart();
      } else {
         drawLikesDonutChart();
      }
   }

   function drawShareChart() {
      var shareData = new google.visualization.DataTable();
      shareData.addColumn('string', 'Post Title');
      shareData.addColumn('number', 'Share Count');

      <?php foreach ($shareCountDonut as $postTitle => $shareCount) : ?>
         shareData.addRow(['<?php echo $postTitle; ?>', <?php echo $shareCount; ?>]);
      <?php endforeach; ?>

      var options = getLikesChartOptions('Share Count per Post');

      var shareChart = new google.visualization.PieChart(document.getElementById('shareChart'));
      shareChart.draw(shareData, options);
   }

   // Function to toggle chart type
   function toggleChartType() {
      if (currentChartType === 'column') {
         currentChartType = 'donut';
         drawLikesDonutChart();
         console.log(1);
         document.getElementById('chart_toggle').innerHTML = '<i class="fa-solid fa-chart-simple"></i>';
      } else {
         currentChartType = 'column';
         drawLikesColumnChart();
         console.log(2);
         document.getElementById('chart_toggle').innerHTML = '<i class="fa-solid fa-chart-pie"></i>';
      }
   }

   // Function to draw column chart
   function drawLikesColumnChart() {
      var likesData = new google.visualization.DataTable();
      likesData.addColumn('string', 'Post Title');
      likesData.addColumn('number', 'Like Count');

      <?php foreach ($postLikesColumn as $postTitle => $likeCount) : ?>
         likesData.addRow(['<?php echo $postTitle; ?>', <?php echo $likeCount; ?>]);
      <?php endforeach; ?>

      var options = getLikesChartOptions('Likes per Post');

      var likesChart = new google.visualization.ColumnChart(document.getElementById('likesChart'));
      likesChart.draw(likesData, options);
   }

   // Function to draw donut chart
   function drawLikesDonutChart() {
      var likesData = new google.visualization.DataTable();
      likesData.addColumn('string', 'Post ID');
      likesData.addColumn('number', 'Like Count');

      <?php foreach ($postLikesDonut as $postTitle => $likeCount) : ?>
         likesData.addRow(['<?php echo $postTitle; ?>', <?php echo $likeCount; ?>]);
      <?php endforeach; ?>

      var options = getLikesChartOptions('Likes per Post');

      // Add legend for 'Post ID'
      options.legend = {
         position: 'bottom',
         alignment: 'center',
         textStyle: {
            color: 'white'
         }
      };

      var likesChart = new google.visualization.PieChart(document.getElementById('likesChart'));
      likesChart.draw(likesData, options);
   }

   // Function to get common chart options
   function getChartOptions(title) {
      return {
         title: title,
         pieHole: 0.4,
         backgroundColor: 'transparent',
         legend: {
            textStyle: {
               color: 'white'
            }
         },
         titleTextStyle: {
            color: 'white'
         },
         slices: {
            0: {
               color: 'teal'
            },
            1: {
               color: 'gold'
            }
         }
      };
   }

   // Function to get likes chart options
   function getLikesChartOptions(title) {
      return {
         title: title,
         pieHole: 0.4, // Make it a donut chart
         backgroundColor: 'transparent',
         legend: {
            textStyle: {
               color: 'white'
            }
         },
         titleTextStyle: {
            color: 'white'
         },
         slices: {
            0: {
               color: 'teal'
            },
            1: {
               color: 'gold'
            }
            // Add more colors if needed for additional slices
         },
         hAxis: {
            title: 'Post Title',
            titleTextStyle: {
               color: 'white'
            },
            textStyle: {
               color: 'white'
            }
         },
         vAxis: {
            title: 'Like Count',
            titleTextStyle: {
               color: 'white'
            },
            textStyle: {
               color: 'white'
            }
         }
      };
   }
</script>