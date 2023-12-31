<?php
require_once "../../Admin_Global/page_initiators.php";
require_once "../../Admin_Global/fetch_applicants.php";
require_once "../../Admin_Database/wma.php";
?>
<div class="content_container">
   <?php
   $content_sql = "SELECT c.*,
                        COUNT(DISTINCT us.content_id) as standard_like_count,
                        COUNT(DISTINCT ug.content_id) as google_like_count
                        FROM wma_content c
                        LEFT JOIN wma_standard_content us ON c.id = us.content_id
                        LEFT JOIN wma_google_content ug ON c.id = ug.content_id
                        GROUP BY c.id";
   $display_result = $conn->query($content_sql);

   function getLikeCount($conn, $content_id)
   {
      $slc = $conn->query("SELECT COUNT(*) FROM wma_standard_content WHERE content_id = $content_id")->fetch_assoc()["COUNT(*)"];
      $glc = $conn->query("SELECT COUNT(*) FROM wma_google_content WHERE content_id = $content_id")->fetch_assoc()["COUNT(*)"];
      return $slc + $glc;
   }

   while ($row = $display_result->fetch_assoc()) {
      $title = $row['title'];
      $content_id = $row['id'];
      $content = $row['content'];
      $excerpt = $row['excerpt'];
      $category = $row['category'];
      $share_count = $row['share_count'];
      $post_status = $row['post_status'];
      $date_published = $row['date_published'];
      $total_like_count = getLikeCount($conn, $content_id);
      ?>
      <div class="post_card" id="post_card_<?php echo $content_id; ?>">
         <div class="post_card_image"
            style="background-image: url(../../../Photos/News_and_Content/<?php echo $content_id; ?>.jpg);">

            <a href="../News_And_Content/content_edit.php?content_id=<?= $content_id ?>" class="content_edit">
               <i class="fa-regular fa-pen-to-square"></i>
            </a>
            <!-- <a href="#" class="content_delete" onclick="confirmDelete('<?= $content_id ?>')">
               <i class="fa-solid fa-trash"></i> -->
            </a>
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
               <i class="fa-solid fa-heart">
                  <span class="like-count">
                     <?php echo max(0, $total_like_count); ?>
                  </span>
               </i>

               <i class="fa-regular fa-paper-plane share-button" onclick="toggleSocialIcons(<?php echo $content_id; ?>)">
                  <span id="totalShareCount_<?php echo $content_id; ?>">
                     <?php echo $share_count; ?>
                  </span>
               </i>
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
   if ($display_result->num_rows === 0) {
      echo "No posts found.";
   }
   ?>
</div>