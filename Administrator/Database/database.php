<?php
// Database configuration
$servername = "localhost"; // Replace with your database server hostname or IP address
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$database = "wma_administrator"; // Replace with your database name

// Create a database connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>