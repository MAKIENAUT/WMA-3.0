<?php
require_once "../Dashboard_Scripts/session_segregator.php";
require_once "../../Database/wma_administrator.php";
require_once '../../Database/wma_forms.php';

if (!isset($_SESSION['admin_id']) && empty($_SESSION['admin_id'])) {
    header('Location: ../../Admin_Login/admin_login.php');
    exit(); // Make sure to exit after a header redirect
}

$user_id = $_SESSION['admin_id'];
$email_address = $_SESSION['email_address'];
$username = $_SESSION['username'];
$access_credential = $_SESSION['access_credential'];

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission here
    // Make sure to process the uploaded files and update the database accordingly
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
            <?php
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
            ?>

            <?php
            if (!empty($applicants)) {
               foreach ($applicants as $applicant) {
                  ?>
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
                  <?php
               }
            } else {
               echo "<h1>No data found for the provided email</h1>";
            }
            ?>

            <div class='applicant_card'>
               <h2>Upload Documents</h2>
               <form method="post" enctype="multipart/form-data">
                  <label for="resume">Resume (.pdf):</label>
                  <input type="file" id="resume" name="resume" accept=".pdf" required><br>

                  <label for="passport">Passport (.pdf):</label>
                  <input type="file" id="passport" name="passport" accept=".pdf" required><br>

                  <label for="background_check">Background Check Report (.pdf):</label>
                  <input type="file" id="background_check" name="background_check" accept=".pdf" required><br>

                  <label for="employment_letter">Employment Letter of Reference (.pdf):</label>
                  <input type="file" id="employment_letter" name="employment_letter" accept=".pdf" required><br>

                  <label for="colleague_reference">Letter of Reference from a Colleague (.pdf):</label>
                  <input type="file" id="colleague_reference" name="colleague_reference" accept=".pdf" required><br>

                  <label for="supervisor_reference">Letter of Reference from a Supervisor (.pdf):</label>
                  <input type="file" id="supervisor_reference" name="supervisor_reference" accept=".pdf" required><br>

                  <label for="cultural_activity_letter">Current School Cultural Activity Letter (.pdf):</label>
                  <input type="file" id="cultural_activity_letter" name="cultural_activity_letter" accept=".pdf"
                     required><br>

                  <label for="diploma">Diploma (.pdf):</label>
                  <input type="file" id="diploma" name="diploma" accept=".pdf" required><br>

                  <label for="foreign_education_evaluation">Foreign Education Evaluation (.pdf):</label>
                  <input type="file" id="foreign_education_evaluation" name="foreign_education_evaluation" accept=".pdf"
                     required><br>

                  <label for="teaching_certificate">Copy of Teaching Certificate (.pdf):</label>
                  <input type="file" id="teaching_certificate" name="teaching_certificate" accept=".pdf" required><br>

                  <label for="language_proficiency">Proof of Language Proficiency (.pdf):</label>
                  <input type="file" id="language_proficiency" name="language_proficiency" accept=".pdf" required><br>

                  <label for="offer_letter">Teacher School Offer Letter (.pdf):</label>
                  <input type="file" id="offer_letter" name="offer_letter" accept=".pdf" required><br>

                  <input type="hidden" name="email" value="<?php echo $applicant['email_address']; ?>">
                  <input type="submit" value="Upload">
               </form>
            </div>

         </div>
      </div>
   </main>
</body>

</html>