<?php
require_once '../../Database/wma_administrator.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

$query_admin = "SELECT * FROM wma_admin";
$result_admin = $conn->query($query_admin);

$wma_admins = [];

if ($result_admin) {
   while ($row = $result_admin->fetch_assoc()) {
      $wma_admins[] = $row;
   }

   $result_admin->free();
   $conn->close(); // Move the connection close here after you're done with the result set
} else {
   echo "Error: " . $conn->error;
}
?>

<h3>Administrator Users</h3>

<div class="admin_cards_container">
   <?php
   foreach ($wma_admins as $admin_users): ?>
      <div class="admin_cards" style="border: 1px solid rgb(0, 133, 133, 0.4);">
         <div class="admin_card_pfp"
            style="background-image:url(../../Admin_Profile/Profile_Picture/<?php echo $admin_users['email_address'] . ".jpg"; ?>);"
            alt="">
         </div>
         <p class="admin_username">
            <?php echo $admin_users['username']; ?> -
            <?php $credential = ucwords(str_replace('_', ' ', $admin_users['access_credential']));
            echo $credential; ?>
         </p>
         <p class="admin_email">
            <?php echo $admin_users['email_address']; ?>
         </p>
         <p class="last_login">Last Login:
            <?php
            $last_login = strtotime($admin_users['last_login']) + (6 * 3600); // Add 6 hours in seconds
            echo date('F j, D - h:iA', $last_login);
            ?>
         </p>

         <p class="last_logout">Last Logout:
            <?php
            $last_logout = strtotime($admin_users['last_logout']) + (6 * 3600); // Add 6 hours in seconds
            echo date('F j, D - h:iA', $last_logout);
            ?>
         </p>


      </div>
   <?php endforeach; ?>
</div>