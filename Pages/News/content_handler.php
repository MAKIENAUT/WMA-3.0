<?php
require_once "../../Administrator/Admin_Database/wma.php";
require_once "functions.php";


$content_sql = "SELECT c.*,
                        COUNT(DISTINCT us.content_id) as standard_like_count,
                        COUNT(DISTINCT ug.content_id) as google_like_count
                        FROM wma_content c
                        LEFT JOIN wma_standard_content us ON c.id = us.content_id
                        LEFT JOIN wma_google_content ug ON c.id = ug.content_id
                        GROUP BY c.id";
$content_result = $conn->query($content_sql);


if (isset($_SESSION['id'])) {
   $user_id = $userinfo['id'];
   $content_table = 'wma_standard_content';
   $content_table_foreign = 'user_id';
} elseif (isset($_SESSION['user_token'])) {
   $user_id = $_SESSION['user_token'];
   $content_table = 'wma_google_content';
   $content_table_foreign = 'user_token';
} else {
   displayContentCardsStandard($conn, $content_result);
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
   $total_like_count = getLikeCount($conn, $content_id);
   $content_url = 'https://www.westmigrationagency.com/Pages/News/news.php#' . $content_id;
   $check_like_result = $conn->query("SELECT * FROM $content_table WHERE $content_table_foreign = $user_id AND content_id = $content_id");
   $like_status = ($check_like_result->num_rows > 0) ? 'unlike' : 'like';
   ?>
   <div class="post_card" id="<?= $content_id ?>" data-id="<?= $title ?>" data-content="<?= $content ?>"
      data-excerpt="<?= $excerpt ?>" data-category="<?= $category ?>" data-date_published="<?= $date_published ?>"
      data-search="<?= strtolower("$title, $content, $excerpt, $category, $date_published") ?>">
      <div class="post_card_image"
         style="background-image: url(../../Photos/News_and_Content/<?php echo $content_id; ?>.jpg);">
      </div>

      <div class="headline_section">
         <div class="title_box">
            <h3>
               <?= $title ?>
            </h3>
            <p>
               <?php echo $date_published; ?>
            </p>
         </div>
         <div class="interaction_info">
            <button class="like-button" data-action="<?php echo $like_status; ?>"
               data-content-id="<?php echo $content_id; ?>">
               <?php if ($like_status == 'like'): ?>
                  <i class="fa-regular fa-heart"></i>
               <?php else: ?>
                  <i class="fa-solid fa-heart" style="color: red;"></i>
               <?php endif; ?>
               <span class="like-count">
                  <?php echo max(0, $total_like_count); ?>
               </span>
            </button>

            <i class="fa-regular fa-paper-plane share-button" onclick="toggleSocialIcons(<?php echo $content_id; ?>)">
               <span id="totalShareCount_<?php echo $content_id; ?>">
                  <?php echo $share_count; ?>
               </span>
            </i>

            <div class="social-icons" id="socialIcons_<?php echo $content_id; ?>" style="display: flex;">
               <?php $socialLinks = [
                  "https://www.facebook.com/sharer/sharer.php?u=" . urlencode($content_url) => "fab fa-facebook-f",
                  "https://twitter.com/intent/tweet?url=" . urlencode($content_url) . "&text=" . urlencode($title) => "fab fa-twitter",
                  "whatsapp://send?text=" . urlencode($title . ' - ' . $content_url) => "fab fa-whatsapp",
                  "http://www.facebook.com/dialog/send?link=" . urlencode($content_url) => "fab fa-facebook-messenger",
                  "https://www.instagram.com/share?url=" . urlencode($content_url) . "&title=" . urlencode($title) => "fab fa-instagram"
               ]; ?>
               <?php foreach ($socialLinks as $link => $icon): ?>
                  <a href="<?php echo $link; ?>" target="_blank" onclick="incrementShareCount(<?php echo $content_id; ?>)">
                     <i class="<?php echo $icon; ?>"></i>
                  </a>
               <?php endforeach; ?>
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