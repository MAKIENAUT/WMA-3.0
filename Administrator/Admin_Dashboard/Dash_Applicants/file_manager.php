<?php
require_once "../Dashboard_Scripts/session_segregator.php";
require_once "../../Database/wma_administrator.php";
require_once '../../Database/wma_forms.php';

if (!isset($_SESSION['admin_id']) && empty($_SESSION['admin_id'])) {
   header('Location: ../../Admin_Login/admin_login.php');
   exit();
}

$user_id = $_SESSION['admin_id'];
$email_address = $_SESSION['email_address'];
$username = $_SESSION['username'];
$access_credential = $_SESSION['access_credential'];

if (isset($_GET['email'])) {
   $email = $_GET['email'];
   $query = "SELECT * FROM j1_visa WHERE email_address = '$email'";
   $result = $conn->query($query);

   $applicants = [];

   if ($result) {
      while ($row = $result->fetch_assoc()) {
         $applicants[] = $row;
      }

      $result->free();
   } else {
      echo "Error: " . $conn->error;
   }

   $conn->close();
} else {
   echo "<h1>Email not provided</h1>";
}

if (!empty($applicants)) {
   foreach ($applicants as $applicant) {
      $id = $applicant['id'];
      $firstName = $applicant['first_name'];
      $lastName = $applicant['last_name'];
      $emailAddress = $applicant['email_address'];
   }
} else {
   echo "<h1>No data found for the provided email</h1>";
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (isset($_POST['email'])) {
      $applicantEmail = $_POST['email'];
      $targetDirectory = "../../Applicant_Files/$applicantEmail/";

      if (!is_dir($targetDirectory)) {
         mkdir($targetDirectory, 0777, true);
      }

      foreach ($_FILES as $fileInput => $file) {
         $fileName = $file['name'];
         $fileTmpName = $file['tmp_name'];
         $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
         $fieldInputName = strtolower(basename($fileInput));

         // Get last name of the applicant
         $lastName = $applicant['last_name'];

         // Define an array of accepted file types
         $acceptedTypes = ['resume', 'passport', 'background_check', 'employment_letter', 'colleague_reference', 'supervisor_reference', 'cultural_activity_letter', 'diploma', 'foreign_education_evaluation', 'teaching_certificate', 'language_proficiency', 'offer_letter'];

         if (in_array($fieldInputName, $acceptedTypes)) {
            $fieldInputName = ucwords($fieldInputName, "_"); // Capitalize after underscore
            $fileNewName = $lastName . "_" . $fieldInputName . ".pdf"; // Adjusted line
            $targetFile = $targetDirectory . $fileNewName;

            if ($fileType == "pdf") {
               if (!file_exists($targetFile)) {
                  if (move_uploaded_file($fileTmpName, $targetFile)) {
                     // File uploaded successfully
                     // You can also update the database with the new file name
                  } else {
                     echo "Error uploading $fileName.";
                  }
               }
            } else {
               echo "Invalid file type for $fileName. Please upload a PDF.";
            }
         } else {
            echo "Invalid field name $fieldInputName.";
         }
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <link rel="stylesheet" href="../Dash_Overview/dash_overview.css">
   <link rel="stylesheet" href="../Dash_Global/dash_global.css">
   <link rel="stylesheet" href="../../../Pages/Global/global.css" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
   <title>Applicant Database</title>

   <style>
      .main_left {
         width: 100%;
         height: 100%;
      }

      .applicant_navigator h3 {
         font-size: 1.5rem;
      }

      .applicant_database {
         display: flex;
         justify-content: space-evenly;
         height: 100%;
      }

      .applicant_card {
         height: 75%;
      }
   </style>
</head>

<body onload="navbar_setting()">

   <?php require_once "../Dash_Global/dash_navbar.php"; ?>


   <main>
      <div class="main_left">
         <div class="main_title">
            <h1>
               <i class="fa-regular fa-folder-open"></i> &nbsp; Applicant File Manager
            </h1>
         </div>

         <div class="applicant_database">

            <div class='applicant_card'>
               <p>ID:
                  <?php echo $applicant['id']; ?>
               </p>
               <p>First Name:
                  <?php echo $applicant['first_name']; ?>
               </p>
               <p>Last Name:
                  <?php echo $applicant['last_name']; ?>
               </p>
               <p>Email Address:
                  <?php echo $applicant['email_address']; ?>
               </p>

            </div>


            <div class='applicant_card'>
               <h2>Upload Documents</h2>
               <form method="post" enctype="multipart/form-data">
                  <?php
                  $email = $applicant['email_address'];
                  $targetDirectory = "../../Applicant_Files/$email/";

                  // Check if directory exists
                  if (is_dir($targetDirectory)) {
                     $existingFiles = scandir($targetDirectory);

                     // List of expected field names
                     $fieldNames = [
                        'Resume',
                        'Passport',
                        'Background_Check',
                        'Employment_Letter',
                        'Colleague_Reference',
                        'Supervisor_Reference',
                        'Cultural_Activity_Letter',
                        'Diploma',
                        'Foreign_Education_Evaluation',
                        'Teaching_Certificate',
                        'Language_Proficiency',
                        'Offer_Letter'
                     ];

                     foreach ($fieldNames as $fieldName) {
                        $fileExists = in_array($applicant['last_name'] . "_" . $fieldName . ".pdf", $existingFiles);
                        $inputType = $fileExists ? 'hidden' : 'file';
                        $inputName = $fileExists ? 'existing_file' : $fieldName;
                        $labelText = $fileExists ? "$fieldName (File Exists)" : "$fieldName (.pdf)";

                        echo "<label for='$fieldName'>$labelText:</label>";
                        echo "<input type='$inputType' id='$fieldName' name='$inputName' accept='.pdf' required><br>";
                     }
                  } else {
                     echo "<p>Directory $targetDirectory does not exist.</p>";
                  }
                  ?>

                  <input type="hidden" name="email" value="<?php echo $email; ?>">
                  <input type="submit" value="Upload">
               </form>
            </div>

         </div>
      </div>
   </main>
</body>

</html>