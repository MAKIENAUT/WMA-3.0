<?php
if(isset($_GET['file']) && isset($_GET['email'])) {
    $file = $_GET['file'];
    $email = $_GET['email'];
    $directory = "../../Applicant_Files/" . $email;
    $file_path = $directory . '/' . $file; // Define the file path

    if (file_exists($file_path)) {
        unlink($file_path);
        header('Location: ' . $_SERVER['HTTP_REFERER']); // Redirect back to the previous page after deletion
        exit();
    } else {
        echo "File not found.";
    }
} else {
    echo "Invalid request.";
}
?>
