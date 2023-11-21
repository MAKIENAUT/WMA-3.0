<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />

   <!-- FontAwesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
   <!-- FontAwesome -->
   <link rel="stylesheet" href="news.css" />
   <link rel="stylesheet" href="../Global/global.css">
   <link rel="icon" type="image/x-icon" href="/Photos/WMA.png">
   <script defer src="../Global/global.js"></script>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="see_more.js"></script>
   <title>WMA News</title>
</head>

<body onload="filter_content('all')">
   <!-- NAV SECTION -->
   <?php require_once "../Global/navbar.php"; ?>

   <!-- MAIN SECTION -->
   <main>
      <div class="sidebar">
         <div class="search_bar">
            <input type="text" id="searchbar" name="searchbar" placeholder="🔎 Search" oninput="content_search()">
         </div>

         <div class="content_view">
            <div class="selector_buttons">
               <label>
                  <input checked type="radio" name="content_selector" id="all" onchange="filter_content('all')">
                  <p>All</p>
               </label>

               <label>
                  <input type="radio" name="content_selector" id="news" onchange="filter_content('news')">
                  <p>News</p>
               </label>

               <label>
                  <input type="radio" name="content_selector" id="post" onchange="filter_content('post')">
                  <p>Post</p>
               </label>
            </div>
         </div>
         <div class="featured_posts">
            <h3 class="featured_title">Featured Posts</h3>
            <?php require_once "featured_content.php"; ?>
         </div>
      </div>

      <div class="content_container">
         <?php require_once "content_handler.php"; ?>
      </div>
   </main>
   <script src="news.js"></script>
</body>

</html>