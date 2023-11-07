<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />

   <!-- FontAwesome -->
   <link rel="stylesheet" crossorigin="anonymous" referrerpolicy="no-referrer"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
      integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" />
   <!-- FontAwesome -->

   <link rel="stylesheet" href="news.css" />
   <link rel="stylesheet" href="/Pages/Global/global.css" />
   <link rel="icon" type="image/x-icon" href="/Photos/WMA.png">
   <script defer src="/Pages/Global/global.js"></script>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <title>WMA News</title>
</head>

<body>
   <!-- NAV SECTION -->
   <?php require_once "../Global/navbar.php" ?>

   <!-- MAIN SECTION -->
   <main>
      <?php
      require_once "../../Administrator/Admin_Database/wma_content.php";
      require_once "../../Administrator/Admin_Database/wma_users.php";

      $user_id = $userinfo['id'];

      $content_sql = "SELECT c.*, 
                COUNT(DISTINCT us.content_id) as standard_like_count,
                COUNT(DISTINCT ug.content_id) as google_like_count 
                FROM wma_content.content c
                LEFT JOIN wma_users.wma_standard_content us ON c.id = us.content_id
                LEFT JOIN wma_users.wma_google_content ug ON c.id = ug.content_id
                GROUP BY c.id";

      $content_result = $conn->query($content_sql);

      if ($credentialType === "standard_login") {
         $content_table = 'wma_standard_content';
         $content_table_foreign = 'user_id';
         $user_id;
      } elseif ($credentialType === "google_login") {
         $content_table = 'wma_google_content';
         $content_table_foreign = 'user_token';
         $user_id = $_SESSION['user_token'];
      }

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
         $action = $_POST['action'];
         $content_id = $_POST['content_id'];

         if ($action == 'like') {
            $like_sql = $conn->prepare("INSERT INTO wma_users.$content_table (user_id, content_id) VALUES (?, ?)");
            $like_sql->bind_param("ii", $user_id, $content_id);
            if ($like_sql->execute()) {
               echo "Content liked successfully.";
            } else {
               echo "Error: " . $like_sql->error;
            }
         } elseif ($action == 'unlike') {
            $unlike_sql = $conn->prepare("DELETE FROM wma_users.$content_table WHERE user_id = ? AND content_id = ?");
            $unlike_sql->bind_param("ii", $user_id, $content_id);
            if ($unlike_sql->execute()) {
               echo "Content unliked successfully.";
            } else {
               echo "Error: " . $unlike_sql->error;
            }
         }
      }

      while ($row = $content_result->fetch_assoc()) {
         $title = $row['title'];
         $content_id = $row['id'];
         $content = $row['content'];
         $excerpt = $row['excerpt'];
         $category = $row['category'];
         $thumbnail = $row['thumbnail'];
         $post_status = $row['post_status'];
         $date_published = $row['date_published'];


         $slc = $conn->query("SELECT COUNT(*) FROM wma_standard_content WHERE content_id = $content_id")->fetch_assoc()["COUNT(*)"];
         $glc = $conn->query("SELECT COUNT(*) FROM wma_google_content WHERE content_id = $content_id")->fetch_assoc()["COUNT(*)"];

         $total_like_count = $slc + $glc;

         $check_like_result = $conn->query("SELECT * FROM wma_users.$content_table WHERE $content_table_foreign = $user_id AND content_id = $content_id");
         $like_status = ($check_like_result->num_rows > 0) ? 'unlike' : 'like';
         ?>
         <div>
            <h2>
               <?php echo $title; ?>
            </h2>
            <p>
               <?php echo $content; ?>
            </p>
            <p>
               <?php echo $thumbnail; ?>
            </p>
            <p>
               <?php echo $excerpt; ?>
            </p>
            <p>
               <?php echo $date_published; ?>
            </p>
            <p>
               <?php echo $post_status; ?>
            </p>
            <p>
               <?php echo $category; ?>
            </p>
            <div>
               Total Likes: <span class="like-count">
                  <?php echo max(0, $total_like_count); ?>
               </span>
            </div>
            <button class="like-button" data-action="<?php echo $like_status; ?>"
               data-content-id="<?php echo $content_id; ?>">
               <?php echo $like_status; ?>
            </button>
         </div>
      <?php } ?>
      <?php if ($content_result->num_rows === 0) {
         echo "No posts found.";
      } ?>
   </main>
   <script src="news.js"></script>
</body>

</html>