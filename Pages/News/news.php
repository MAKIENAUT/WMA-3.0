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
   <script src="see_more.js"></script>
   <link rel="stylesheet" href="news.css" />
   <link rel="stylesheet" href="../Global/global.css">
   <link rel="icon" type="image/x-icon" href="/Photos/WMA.png">
   <script defer src="../Global/global.js"></script>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <title>WMA News</title>
</head>

<body>
   <!-- NAV SECTION -->
   <?php require_once "../Global/navbar.php"; ?>

   <!-- MAIN SECTION -->
   <main>
      <div class="content_container">

         <?php
         require_once "../../Administrator/Admin_Database/wma_content.php";
         require_once "../../Administrator/Admin_Database/wma_users.php";


         $content_sql = "SELECT c.*,
                        COUNT(DISTINCT us.content_id) as standard_like_count,
                        COUNT(DISTINCT ug.content_id) as google_like_count
                        FROM wma_content.content c
                        LEFT JOIN wma_users.wma_standard_content us ON c.id = us.content_id
                        LEFT JOIN wma_users.wma_google_content ug ON c.id = ug.content_id
                        GROUP BY c.id";
         $content_result = $conn->query($content_sql);
         if (isset($_SESSION['id'])) {
            $user_id = $userinfo['id'];
            $content_table = 'wma_standard_content';
            $content_table_foreign = 'user_id';
            $user_id;
         } elseif (isset($_SESSION['user_token'])) {
            $user_id = $userinfo['id'];
            $content_table = 'wma_google_content';
            $content_table_foreign = 'user_token';
            $user_id = $_SESSION['user_token'];
         } else {
            $content_sql = "SELECT * FROM wma_content.content";
            $content_result = $conn->query($content_sql);
            while ($row = $content_result->fetch_assoc()) {
               $title = $row['title'];
               $content_id = $row['id'];
               $content = $row['content'];
               $excerpt = $row['excerpt'];
               $category = $row['category'];
               $post_status = $row['post_status'];
               $share_count = $row['share_count'];
               $date_published = $row['date_published'];
               $content_url = 'https://www.westmigrationagency.com/Pages/News/news.php#' . $content_id;
               $slc = $conn->query("SELECT COUNT(*) FROM wma_standard_content WHERE content_id = $content_id")->fetch_assoc()["COUNT(*)"];
               $glc = $conn->query("SELECT COUNT(*) FROM wma_google_content WHERE content_id = $content_id")->fetch_assoc()["COUNT(*)"];
               $total_like_count = $slc + $glc;
               ?>
               <div class="post_card" id="<?php echo $content_id; ?>">
                  <div class="post_card_image"
                     style="background-image: url(../../Photos/News_and_Content/<?php echo $content_id; ?>.jpg);">
                  </div>

                  <div class="headline_section">
                     <div class="title_box">
                        <h3>
                           <?php echo $title; ?>
                        </h3>
                        <p>
                           <?php echo $date_published; ?>
                        </p>
                     </div>
                     <div class="interaction_info">
                        <a href="../../Users/Standard_User/Standard_Login/user_login.php" class="like-button">
                           <i class="fa-regular fa-heart"></i>
                           <span class="like-count">
                              <?php echo max(0, $total_like_count); ?>
                           </span>
                        </a>

                        <i class="fa-regular fa-paper-plane share-button"
                           onclick="toggleSocialIcons(<?php echo $content_id; ?>)">
                           <span id="totalShareCount_<?php echo $content_id; ?>">
                              <?php echo $share_count; ?>
                           </span>
                        </i>

                        <div class="social-icons" id="socialIcons_<?php echo $content_id; ?>" style="display: none;">
                           <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($content_url); ?>"
                              target="_blank" onclick="incrementShareCount(<?php echo $content_id; ?>)">
                              <i class="fab fa-facebook-f"></i>
                           </a>

                           <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode($content_url); ?>&text=<?php echo urlencode($title); ?>"
                              target="_blank" onclick="incrementShareCount(<?php echo $content_id; ?>)">
                              <i class="fab fa-twitter"></i>
                           </a>

                           <a href="whatsapp://send?text=<?php echo urlencode($title . ' - ' . $content_url); ?>"
                              target="_blank" onclick="incrementShareCount(<?php echo $content_id; ?>)">
                              <i class="fab fa-whatsapp"></i>
                           </a>

                           <!-- Messenger -->
                           <a href="http://www.facebook.com/dialog/send?link=<?php echo urlencode($content_url); ?>"
                              target="_blank" onclick="incrementShareCount(<?php echo $content_id; ?>)">
                              <i class="fab fa-facebook-messenger"></i>
                           </a>

                           <!-- Instagram -->
                           <a href="https://www.instagram.com/share?url=<?php echo urlencode($content_url); ?>&title=<?php echo urlencode($title); ?>"
                              target="_blank" onclick="incrementShareCount(<?php echo $content_id; ?>)">
                              <i class="fab fa-instagram"></i>
                           </a>
                        </div>

                     </div>
                  </div>
                  <p class="excerpt" id="excerptContainer_<?php echo $content_id; ?>">
                     <?php
                     $trimmed_excerpt = strlen($excerpt) > 120 ? substr($excerpt, 0, 120) . "..." : $excerpt;
                     echo $trimmed_excerpt;
                     ?>
                     <?php if (strlen($excerpt) <= 120): ?>
                        <a class="read-more-btn" onclick="toggleExcerpt(<?php echo $content_id; ?>)">See More</a>
                     <?php endif; ?>
                  </p>

                  <div class="full_excerpt" id="fullExcerptContainer_<?php echo $content_id; ?>" style="display: none;">
                     <?php echo $content; ?>
                     <?php if (strlen($content) > 120): ?>
                        <a class="read-less-btn" onclick="collapseExcerpt(<?php echo $content_id; ?>)">See Less</a>
                     <?php endif; ?>
                  </div>
               </div>
               <?php
            }
            if ($content_result->num_rows === 0) {
               echo "No posts found.";
            }
            exit();
         }
         while ($row = $content_result->fetch_assoc()) {
            $title = $row['title'];
            $content_id = $row['id'];
            $content = $row['content'];
            $excerpt = $row['excerpt'];
            $category = $row['category'];
            $post_status = $row['post_status'];
            $share_count = $row['share_count'];
            $date_published = $row['date_published'];
            $content_url = 'https://www.westmigrationagency.com/Pages/News/news.php#' . $content_id;
            $slc = $conn->query("SELECT COUNT(*) FROM wma_standard_content WHERE content_id = $content_id")->fetch_assoc()["COUNT(*)"];
            $glc = $conn->query("SELECT COUNT(*) FROM wma_google_content WHERE content_id = $content_id")->fetch_assoc()["COUNT(*)"];
            $total_like_count = $slc + $glc;
            $check_like_result = $conn->query("SELECT * FROM wma_users.$content_table WHERE $content_table_foreign = $user_id AND content_id = $content_id");
            $like_status = ($check_like_result->num_rows > 0) ? 'unlike' : 'like';
            ?>
            <div class="post_card">
               <div class="post_card_image"
                  style="background-image: url(../../Photos/News_and_Content/<?php echo $content_id; ?>.jpg);">
               </div>

               <div class="headline_section">
                  <div class="title_box">
                     <h3>
                        <?php echo $title; ?>
                     </h3>
                     <p>
                        <?php echo $date_published; ?>
                     </p>
                  </div>
                  <div class="interaction_info">
                     <button class="like-button" data-action="<?php echo $like_status; ?>"
                        data-content-id="<?php echo $content_id; ?>">
                        <?php if ($like_status == 'like'): ?>
                           <i class="fa-solid fa-heart"></i>
                        <?php else: ?>
                           <i class="fa-solid fa-heart" style="color: red;"></i>
                        <?php endif; ?>
                        <span class="like-count">
                           <?php echo max(0, $total_like_count); ?>
                        </span>
                     </button>

                     <i class="fa-regular fa-paper-plane share-button"
                        onclick="toggleSocialIcons(<?php echo $content_id; ?>)">
                        <span id="totalShareCount_<?php echo $content_id; ?>">
                           <?php echo $share_count; ?>
                        </span>
                     </i>

                     <div class="social-icons" id="socialIcons_<?php echo $content_id; ?>" style="display: none;">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($content_url); ?>"
                           target="_blank" onclick="incrementShareCount(<?php echo $content_id; ?>)">
                           <i class="fab fa-facebook-f"></i>
                        </a>

                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode($content_url); ?>&text=<?php echo urlencode($title); ?>"
                           target="_blank" onclick="incrementShareCount(<?php echo $content_id; ?>)">
                           <i class="fab fa-twitter"></i>
                        </a>

                        <a href="whatsapp://send?text=<?php echo urlencode($title . ' - ' . $content_url); ?>"
                           target="_blank" onclick="incrementShareCount(<?php echo $content_id; ?>)">
                           <i class="fab fa-whatsapp"></i>
                        </a>

                        <!-- Messenger -->
                        <a href="http://www.facebook.com/dialog/send?link=<?php echo urlencode($content_url); ?>"
                           target="_blank" onclick="incrementShareCount(<?php echo $content_id; ?>)">
                           <i class="fab fa-facebook-messenger"></i>
                        </a>

                        <!-- Instagram -->
                        <a href="https://www.instagram.com/share?url=<?php echo urlencode($content_url); ?>&title=<?php echo urlencode($title); ?>"
                           target="_blank" onclick="incrementShareCount(<?php echo $content_id; ?>)">
                           <i class="fab fa-instagram"></i>
                        </a>
                     </div>
                  </div>
               </div>
               <p class="excerpt" id="excerptContainer_<?php echo $content_id; ?>">
                  <?php
                  $trimmed_excerpt = strlen($excerpt) > 120 ? substr($excerpt, 0, 120) . "..." : $excerpt;
                  echo $trimmed_excerpt;
                  ?>
                  <?php if (strlen($excerpt) <= 120): ?>
                     <a class="read-more-btn" onclick="toggleExcerpt(<?php echo $content_id; ?>)">See More</a>
                  <?php endif; ?>
               </p>

               <div class="full_excerpt" id="fullExcerptContainer_<?php echo $content_id; ?>" style="display: none;">
                  <?php echo $content; ?>
                  <?php if (strlen($content) > 120): ?>
                     <a class="read-less-btn" onclick="collapseExcerpt(<?php echo $content_id; ?>)">See Less</a>
                  <?php endif; ?>
               </div>

            </div>
         <?php } ?>
         <?php if ($content_result->num_rows === 0) {
            echo "No posts found.";
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
         ?>
      </div>
   </main>
   <script src="news.js"></script>
</body>

</html>