<?php
require_once 'config.php';

// authenticate code from Google OAuth Flow
if (isset($_GET['code'])) {
   $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
   $client->setAccessToken($token['access_token']);

   // get profile info
   $google_oauth = new Google_Service_Oauth2($client);
   $google_account_info = $google_oauth->userinfo->get();
   $userinfo = [
      'email' => $google_account_info['email'],
      'first_name' => $google_account_info['givenName'],
      'last_name' => $google_account_info['familyName'],
      'full_name' => $google_account_info['name'],
      'picture' => $google_account_info['picture'],
      'verifiedEmail' => $google_account_info['verifiedEmail'],
      'token' => $google_account_info['id'],
   ];

   // checking if user is already exists in database
   $sql = "SELECT * FROM wma_users_google WHERE email ='{$userinfo['email']}'";
   $result = mysqli_query($conn, $sql);
   if (mysqli_num_rows($result) > 0) {
      // user exists
      $userinfo = mysqli_fetch_assoc($result);
      $token = $userinfo['token'];
   } else {
      // user does not exist
      $sql = "INSERT INTO wma_users_google (email, first_name, last_name, full_name, picture, verifiedEmail, token) VALUES ('{$userinfo['email']}', '{$userinfo['first_name']}', '{$userinfo['last_name']}', '{$userinfo['full_name']}', '{$userinfo['picture']}', '{$userinfo['verifiedEmail']}', '{$userinfo['token']}')";
      $result = mysqli_query($conn, $sql);
      if ($result) {
         $token = $userinfo['token'];
      } else {
         echo "User is not created";
         die();
      }
   }
   session_name('user_session');
   // save user data into session
   $_SESSION['user_token'] = $token;
   

   // Redirect to home page
   header("Location: ../../Pages/Home/home.php");
   die(); // Ensure script stops executing after redirect
} else {
   if (!isset($_SESSION['user_token'])) {
      header("Location: ../../Users/Standard_User/Standard_Login/user_login.php");
      die();
   }
}
?>


<!-- 

   Kung ayaw mo sa'kin, huwag na muna natin pag-usapan

   

 -->