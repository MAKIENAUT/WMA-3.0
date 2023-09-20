<?php

require_once 'vendor/autoload.php';

session_start();

// init configuration
$clientID = '174256079121-cems81j7m9jv631qtacktje1ticjrg2t.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost:3000/welcome.php';

// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

// Connect to database
$hostname = "localhost";
$username = "root";
$password = "";
$database = "wma_users";

$conn = mysqli_connect($hostname, $username, $password, $database);

?>