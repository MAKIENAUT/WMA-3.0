<?php
require_once "functions.php";

$post_status = 'featured';

$featured_sql = "SELECT * FROM wma_content.content WHERE post_status = 'featured'";

$featured_result = $conn->query($featured_sql);

while ($row = $featured_result->fetch_assoc()) {
   $title = $row['title'];
   $content_id = $row['id'];
   $content = $row['content'];
   $excerpt = $row['excerpt'];
   $category = $row['category'];
   $share_count = $row['share_count'];
   $date_published = $row['date_published'];
   $content_url = 'https://www.westmigrationagency.com/Pages/News/news.php#' . $content_id;
   $total_like_count = getLikeCount($conn, $content_id);
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

            <i class="fa-regular fa-paper-plane share-button" onclick="toggleSocialIcons(<?php echo $content_id; ?>)">
               <span id="totalShareCount_<?php echo $content_id; ?>">
                  <?php echo $share_count; ?>
               </span>
            </i>

            <div class="social-icons" id="socialIcons_<?php echo $content_id; ?>" style="display: none;">
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
      <p class="excerpt" id="featuredExcerptContainer_<?php echo $content_id; ?>">
         <?php
         $trimmed_excerpt = strlen($excerpt) > 120 ? substr($excerpt, 0, 120) . "..." : $excerpt;
         echo $trimmed_excerpt;
         ?>
         <?php if (strlen($excerpt) <= 120): ?>
            <a class="read-more-btn" onclick="featuredToggleExcerpt(<?php echo $content_id; ?>)">See More</a>
         <?php endif; ?>
      </p>

      <div class="full_excerpt" id="featuredFullExcerptContainer_<?php echo $content_id; ?>" style="display: none;">
         <?php echo $content; ?>
         <?php if (strlen($content) > 120): ?>
            <a class="read-less-btn" onclick="featuredCollapseExcerpt(<?php echo $content_id; ?>)">See Less</a>
         <?php endif; ?>
      </div>
   </div>
   <?php
}

if ($featured_result->num_rows === 0) {
   echo "No posts found.";
}


?>