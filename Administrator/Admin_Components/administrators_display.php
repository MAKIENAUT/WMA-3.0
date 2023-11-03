<?php

require_once "../../Admin_Global/page_initiators.php";
require_once '../../Admin_Global/fetch_administrators.php';
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