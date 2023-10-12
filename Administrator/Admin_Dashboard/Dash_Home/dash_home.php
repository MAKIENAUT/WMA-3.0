<?php
   require_once "../../Database/database.php";

   if (isset($_SESSION["id"])) {
      header('Location: ../../Admin_Login/admin_login.php');
   }


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>
<body>
   <!-- 
   FEATURES:
      - Profile Display
         - Name
         - Profile Picture
         - Access Control
      - CMS (Content Management System)
         - News
         - Posts
      - Applicant Database Display
         - 

    -->
</body>
</html>