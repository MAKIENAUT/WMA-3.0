<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["id"]) || empty($_SESSION["id"])) {
    header("location: ../Standard_Login/user_login.php");
    exit;
}

// Include any necessary resources or configurations for this page

?>

<!DOCTYPE html>
<html>

<head>
    <title>Welcome Page</title>
</head>

<body>
    <h2>Welcome, <?php echo $_SESSION["first_name"] . " " . $_SESSION["last_name"]; ?></h2>
    <p>Email: <?php echo $_SESSION["email"]; ?></p>

    <!-- Display the profile picture -->
    <?php if (!empty($_SESSION["profile_picture"])) : ?>
        <img src="<?php echo $_SESSION["profile_picture"]; ?>" alt="Profile Picture">
    <?php else : ?>
        <!-- Default profile picture or placeholder image if profile picture is not set -->
        <img src="default_profile_picture.jpg" alt="Default Profile Picture">
    <?php endif; ?>

    <a href="../Standard_Logout/logout.php">Logout</a>
    <a href="../../../Pages/Categories/Study_and_Exchange/study_and_exchange.php">Study and Exchange</a>
</body>

</html>
