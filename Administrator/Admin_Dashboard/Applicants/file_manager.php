<?php
require_once "../../Admin_Global/page_initiators.php";
require_once "../../Admin_Global/fetch_demographics.php";
require_once "../../Admin_Global/fetch_applicants.php";

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
      $login_method = $applicant['login_method'];
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
                     echo "<script>console.log('Error uploading $fileName.');</script>";
                  }
               }
            } else {
               echo "<script>console.log('Invalid file type for $fileName. Please upload a PDF.');</script>";
            }
         } else {
            echo "<script>console.log('Invalid field name $fieldInputName.');</script>";
         }
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <link rel="stylesheet" href="file_manager.css">
   <link rel="stylesheet" href="../Overview/overview.css">
   <link rel="stylesheet" href="../../Admin_Global/global.css">
   <link rel="stylesheet" href="../../../Pages/Global/global.css" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="icon" type="image/x-icon" href="../../../Photos/WMA.png">
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
   </style>
</head>

<body onload="navbar_setting()">

   <?php require_once "../../Admin_Global/navbar.php"; ?>


   <main>
      <div class="main_left">
         <div class="main_title">
            <h1>
               <i class="fa-regular fa-folder-open"></i> &nbsp; Applicant File Manager
            </h1>
         </div>

         <div class="file_manager_panel">
            <div class='applicant_card'>

               <?php
               if ($login_method === 'google_login') {
                  foreach ($google_users as $user): ?>
                     <div class="applicant_pfp" style="background-image: url(<?php echo $user['picture'] ?>);">

                     </div>
                  <?php endforeach;
               } elseif ($login_method === 'standard_login') {
                  foreach ($standard_users as $user): ?>
                     <div class="applicant_pfp"
                        style="background-image: url(../../../Users/Standard_User/Standard_Profile/Profile_Pictures/<?php echo $user['email'] ?>/profile_picture.jpg);">

                     </div>
                  <?php endforeach;
               }
               ?>

               <p>ID:
                  <?php echo $applicant['id']; ?>
               </p>
               <p>First Name:
                  <?php echo $applicant['first_name']; ?>
               </p>
               <p>Last Name:
                  <?php echo $applicant['last_name']; ?>
               </p>
               <p>Full Address:
                  <?php echo $applicant['full_address']; ?>
               </p>
               <p>Country:
                  <?php echo $applicant['country']; ?>
               </p>
               <p>Phone Number:
                  <?php echo $applicant['phone_number']; ?>
               </p>
               <p>Email Address:
                  <?php echo $applicant['email_address']; ?>
               </p>
               <p>Profession:
                  <?php echo $applicant['profession']; ?>
               </p>
               <p>Date Submitted:
                  <?php echo $applicant['date_submitted']; ?>
               </p>
               <p>File:
                  <?php echo $applicant['file']; ?>
               </p>
               <p>Login Method:
               </p>
            </div>

            <div class='file_management'>
               <h2>Upload Documents</h2>
               <form method="post" enctype="multipart/form-data">
                  <?php
                  $email = $applicant['email_address'];
                  $targetDirectory = "../../Applicant_Files/$email/";

                  if (is_dir($targetDirectory)) {
                     $existingFiles = scandir($targetDirectory);

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
                        $labelText = $fileExists ? $applicant['last_name'] . "_" . $fieldName . ".pdf" : "$fieldName (.pdf)";
                        ?>

                        <?php if ($fileExists): ?>
                           <div class="existing_file">
                              <i class='fa fa-file-pdf' id="file_icon"></i>
                              <span>
                                 <?= $labelText ?>
                              </span>
                              <div class="file_actions">
                                 <a href='<?= "$targetDirectory/$applicant[last_name]_$fieldName.pdf" ?>' class='download_link'
                                    download><i class='fa fa-download'></i>
                                 </a>
                                 <a href='#' class='delete_link' onclick='confirmDelete("<?= urlencode($applicant['last_name'] . "_" . $fieldName . ".pdf") ?>", "<?= urlencode($email) ?>")'><i class='fa fa-trash'></i></a>

                                 <script>
                                    function confirmDelete(fileName, email) {
                                       var confirmDelete = confirm("Are you sure you want to delete " + fileName + "?");

                                       if (confirmDelete) {
                                          window.location.href = 'delete_file.php?file=' + fileName + '&email=' + email;
                                       }
                                    }
                                 </script>
                              </div>
                           </div>
                        <?php else: ?>
                           <div class="file-drop-zone" id="fileDropZone<?= $fieldName ?>">
                              <label class="file-label" for='<?= $fieldName ?>'>
                                 <span>
                                    <?= $labelText ?>:
                                 </span>
                                 <span class="drop-message">Drag & Drop files here or click to upload</span>
                              </label>
                              <input type='file' id='<?= $fieldName ?>' name='<?= $fieldName ?>' accept='.pdf'
                                 style="display:none;">
                           </div>
                        <?php endif; ?>

                        <script>
                           document.addEventListener('DOMContentLoaded', function () {
                              var fileDropZone<?= $fieldName ?> = document.getElementById('fileDropZone<?= $fieldName ?>');
                              var fileInput<?= $fieldName ?> = document.getElementById('<?= $fieldName ?>');

                              fileDropZone<?= $fieldName ?>.addEventListener('dragover', function (e) {
                                 e.preventDefault();
                                 fileDropZone<?= $fieldName ?>.classList.add('active');
                              });

                              fileDropZone<?= $fieldName ?>.addEventListener('dragleave', function () {
                                 fileDropZone<?= $fieldName ?>.classList.remove('active');
                              });

                              fileDropZone<?= $fieldName ?>.addEventListener('drop', function (e) {
                                 e.preventDefault();
                                 var files = e.dataTransfer.files;
                                 fileInput<?= $fieldName ?>.files = files;
                                 fileDropZone<?= $fieldName ?>.classList.remove('active');
                              });

                              fileDropZone<?= $fieldName ?>.addEventListener('click', function () {
                                 fileInput<?= $fieldName ?>.click();
                              });

                              fileInput<?= $fieldName ?>.addEventListener('change', function () {
                                 var fileName = this.files[0].name;

                                 fileDropZone<?= $fieldName ?>.classList.add('file-uploaded');
                                 fileDropZone<?= $fieldName ?>.querySelector('.drop-message').textContent = fileName;
                              });
                           });
                        </script>

                        <?php
                     }
                  } else {
                     echo "<p>Directory $targetDirectory does not exist.</p>";
                  }
                  ?>

                  <input type="hidden" name="email" value="<?= $email ?>">
                  <div class="submit_button"><input type="submit" value="Upload"></div>
               </form>
            </div>
         </div>
      </div>
   </main>
</body>

</html>