<?php

require_once 'vendor/autoload.php';

// init configuration
$clientID = '174256079121-cems81j7m9jv631qtacktje1ticjrg2t.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost:3000/Users/User_Login_Google/welcome.php';

// create Client Request to access Google API
$client = new Google\Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

// Connect to datbase
$hostname = "localhost";
$username = "root";
$password = "";
$database = "wma_users";

$conn = mysqli_connect($hostname, $username, $password, $database);

?>