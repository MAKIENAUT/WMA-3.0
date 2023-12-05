<?php
require_once "../../Admin_Global/page_initiators.php";
require_once "../../Admin_Database/wma.php";

$errors = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
   $title = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
   $content = htmlspecialchars($_POST['content'], ENT_QUOTES, 'UTF-8');
   $excerpt = htmlspecialchars($_POST['excerpt'], ENT_QUOTES, 'UTF-8');
   $post_status = htmlspecialchars($_POST['post_status'], ENT_QUOTES, 'UTF-8');
   $category = htmlspecialchars($_POST['category'], ENT_QUOTES, 'UTF-8');

   // Validate required fields
   if (empty($title) || empty($content) || empty($excerpt) || empty($post_status) || empty($category)) {
      $errors .= "All fields are required.\n";
   }

   // Get the current date and time
   $date_published = date('Y-m-d H:i:s');

   // Use parameterized query to prevent SQL injection
   $insert_content = $conn->prepare("INSERT INTO wma_content (title, content, excerpt, post_status, category, date_published) VALUES (?, ?, ?, ?, ?, ?)");

   $insert_content->bind_param("ssssss", $title, $content, $excerpt, $post_status, $category, $date_published);

   if ($insert_content->execute()) {
      $errors .= "Data inserted successfully.\n";

      $inserted_id = $conn->insert_id;
      $thumbnail_directory = "../../../Photos/News_and_Content";

      $content_thumbnail = $_FILES['thumbnail']['name'];
      $content_thumbnailExtension = pathinfo($content_thumbnail, PATHINFO_EXTENSION);

      // File upload handling
      $allowed_extensions = array("jpg");
      $max_file_size = 5 * 1024 * 1024; // 5 MB

      if ($_FILES['thumbnail']['error'] !== UPLOAD_ERR_OK) {
         $errors .= "Error uploading thumbnail. \n";
      } elseif (!in_array(strtolower($content_thumbnailExtension), $allowed_extensions)) {
         $errors .= "Invalid file format. Only JPG files are allowed. \n";
      } elseif ($_FILES['thumbnail']['size'] > $max_file_size) {
         $errors .= "File size exceeds the limit. \n";
      } else {
         // Use the inserted ID to create the thumbnail
         $thumbnail_name = $inserted_id . ".jpg";
         $thumbnail_FilePath = $thumbnail_directory . '/' . $thumbnail_name;

         if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $thumbnail_FilePath)) {
            $errors .= "Thumbnail uploaded successfully. \n";
         } else {
            $errors .= "Error uploading thumbnail. \n";
         }
      }

   } else {
      $errors .= "Error: " . $insert_content->error . "\n";
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <script src="content_creator.js"></script>
   <link rel="stylesheet" href="content_creator.css">
   <link rel="stylesheet" href="../../Admin_Global/global.css">
   <link rel="stylesheet" href="../../../Pages/Global/global.css" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <link rel="icon" type="image/x-icon" href="../../../Photos/WMA.png">
   <title>News and Content</title>
</head>

<body>
   <!-- NAVBAR -->
   <?php require_once "../../Admin_Global/navbar.php"; ?>

   <main>
      <div class="main_title">
         <h1>
            <i class="fa-solid fa-hand-sparkles"></i> &nbsp; Content Creator
         </h1>
      </div>

      <div class="creation_panel">
         <p>
            <?php echo $errors; ?>
         </p>
         <form name="content_creation" method="post" enctype="multipart/form-data">
            <fieldset class="thumbnail_fieldset">
               <legend>Thumbnail:</legend>
               <div class="thumbnail-field">
                  <div id="thumbnailContainer" class="thumbnail-container" ondrop="handleDrop(event)"
                     ondragover="handleDragOver(event)">
                     <p id="thumbnailLabel" class="thumbnail-label">Drag & Drop or
                        <label for="thumbnail" class="upload-label">upload a thumbnail</label>
                     </p>
                  </div>
                  <input type="file" accept=".jpg" id="thumbnail" name="thumbnail" class="thumbnail-input"
                     onchange="handleFileSelect(event)">
               </div>
            </fieldset>

            <fieldset class="creator_fieldset">
               <legend>Create a Post/News</legend>
               <input type="hidden" name="id">

               <div class="title_field">
                  <label for="title">
                     <b>*</b> Title:
                  </label>
                  <input type="text" name="title" placeholder="Title:">
               </div>

               <div class="excerpt_field">
                  <label for="excerpt">
                     <b>*</b> Excerpt:
                  </label>
                  <textarea rows="4" cols="30" id="excerpt" name="excerpt" placeholder="A good subtitle:"
                     oninput="limitTextarea(this, 120)"></textarea>
               </div>

               <div class="content_field">
                  <label for="content">
                     <b>*</b> Content:
                  </label>
                  <textarea name="content" id="content" cols="30" rows="10" placeholder="What is going on?!"></textarea>
               </div>

               <div class="radio_fields">
                  <div class="postStatus_field">
                     <label><b>*</b> Post Status: </label>
                     <div class="post_status">
                        <div class="public_field">
                           <input type="radio" name="post_status" value="public">
                           <label for="post_status">Public</label>
                        </div>

                        <div class="private_field">
                           <input type="radio" name="post_status" value="private">
                           <label for="post_status">Private</label>
                        </div>

                        <div class="private_field">
                           <input type="radio" name="post_status" value="featured">
                           <label for="post_status">Featured</label>
                        </div>
                     </div>
                  </div>
                  <div class="category_field">
                     <label><b>*</b> Category: </label>
                     <div class="category">
                        <div class="news_field">
                           <input type="radio" name="category" value="news">
                           <label for="category">News</label>
                        </div>

                        <div class="post_field">
                           <input type="radio" name="category" value="post">
                           <label for="category">Post</label>
                        </div>
                     </div>
                  </div>
               </div>

               <input type="submit" value="Create Content">
            </fieldset>
         </form>
      </div>
   </main>
</body>
</html>
