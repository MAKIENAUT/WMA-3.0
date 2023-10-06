<?php
require_once '../../../Users/User_Login_Google/config.php';

$errors = "";

$countries = [
   'Afghanistan',
   'Albania',
   'Algeria',
   'Andorra',
   'Angola',
   'Antigua and Barbuda',
   'Argentina',
   'Armenia',
   'Australia',
   'Austria',
   'Azerbaijan',
   'Bahamas',
   'Bahrain',
   'Bangladesh',
   'Barbados',
   'Belarus',
   'Belgium',
   'Belize',
   'Benin',
   'Bhutan',
   'Bolivia',
   'Bosnia and Herzegovina',
   'Botswana',
   'Brazil',
   'Brunei',
   'Bulgaria',
   'Burkina Faso',
   'Burundi',
   'Cabo Verde',
   'Cambodia',
   'Cameroon',
   'Canada',
   'Central African Republic',
   'Chad',
   'Chile',
   'China',
   'Colombia',
   'Comoros',
   'Congo (Congo-Brazzaville)',
   'Costa Rica',
   'Croatia',
   'Cuba',
   'Cyprus',
   'Czechia (Czech Republic)',
   'Democratic Republic of the Congo (Congo-Kinshasa)',
   'Denmark',
   'Djibouti',
   'Dominica',
   'Dominican Republic',
   'East Timor (Timor-Leste)',
   'Ecuador',
   'Egypt',
   'El Salvador',
   'Equatorial Guinea',
   'Eritrea',
   'Estonia',
   'Eswatini (fmr. "Swaziland")',
   'Ethiopia',
   'Fiji',
   'Finland',
   'France',
   'Gabon',
   'Gambia',
   'Georgia',
   'Germany',
   'Ghana',
   'Greece',
   'Grenada',
   'Guatemala',
   'Guinea',
   'Guinea-Bissau',
   'Guyana',
   'Haiti',
   'Holy See',
   'Honduras',
   'Hungary',
   'Iceland',
   'India',
   'Indonesia',
   'Iran',
   'Iraq',
   'Ireland',
   'Israel',
   'Italy',
   'Ivory Coast',
   'Jamaica',
   'Japan',
   'Jordan',
   'Kazakhstan',
   'Kenya',
   'Kiribati',
   'Kosovo',
   'Kuwait',
   'Kyrgyzstan',
   'Laos',
   'Latvia',
   'Lebanon',
   'Lesotho',
   'Liberia',
   'Libya',
   'Liechtenstein',
   'Lithuania',
   'Luxembourg',
   'Madagascar',
   'Malawi',
   'Malaysia',
   'Maldives',
   'Mali',
   'Malta',
   'Marshall Islands',
   'Mauritania',
   'Mauritius',
   'Mexico',
   'Micronesia',
   'Moldova',
   'Monaco',
   'Mongolia',
   'Montenegro',
   'Morocco',
   'Mozambique',
   'Myanmar (formerly Burma)',
   'Namibia',
   'Nauru',
   'Nepal',
   'Netherlands',
   'New Zealand',
   'Nicaragua',
   'Niger',
   'Nigeria',
   'North Korea',
   'North Macedonia (formerly Macedonia)',
   'Norway',
   'Oman',
   'Pakistan',
   'Palau',
   'Palestine State',
   'Panama',
   'Papua New Guinea',
   'Paraguay',
   'Peru',
   'Philippines',
   'Poland',
   'Portugal',
   'Qatar',
   'Romania',
   'Russia',
   'Rwanda',
   'Saint Kitts and Nevis',
   'Saint Lucia',
   'Saint Vincent and the Grenadines',
   'Samoa',
   'San Marino',
   'Sao Tome and Principe',
   'Saudi Arabia',
   'Senegal',
   'Serbia',
   'Seychelles',
   'Sierra Leone',
   'Singapore',
   'Slovakia',
   'Slovenia',
   'Solomon Islands',
   'Somalia',
   'South Africa',
   'South Korea',
   'South Sudan',
   'Spain',
   'Sri Lanka',
   'Sudan',
   'Suriname',
   'Sweden',
   'Switzerland',
   'Syria',
   'Tajikistan',
   'Tanzania',
   'Thailand',
   'Timor-Leste (formerly East Timor)',
   'Togo',
   'Tonga',
   'Trinidad and Tobago',
   'Tunisia',
   'Turkey',
   'Turkmenistan',
   'Tuvalu',
   'Uganda',
   'Ukraine',
   'United Arab Emirates',
   'United Kingdom',
   'United States of America',
   'Uruguay',
   'Uzbekistan',
   'Vanuatu',
   'Venezuela',
   'Vietnam',
   'Yemen',
   'Zambia',
   'Zimbabwe'
];

if (!isset($_SESSION['user_token']) && !isset($_SESSION['id'])) {
   header("Location: ../../../Users/User_Login_Google/index.php"); // Redirect to the login page if the user is not logged in
   die();
}

if (isset($_SESSION['user_token'])) {
   $credentialType = 'user_token';
   $sql = "SELECT * FROM wma_users_google WHERE token = '{$_SESSION['user_token']}'";

} elseif (isset($_SESSION['id'])) {
   $credentialType = 'id';
   $sql = "SELECT * FROM wma_users_standard WHERE id = '{$_SESSION['id']}'";
}

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
   $userinfo = mysqli_fetch_assoc($result);
} else {
   $errors .= "User not found in the database. \n";
   die(); // Exit the script if the user is not found
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $first_name = $_POST['first_name'];
   $last_name = $_POST['last_name'];
   $full_address = $_POST['full_address'];
   $country = $_POST['country']; // The selected country
   $phone_number = $_POST['phone_number'];
   $email_address = $_POST['email_address'];
   $profession = $_POST['profession'];

   // Use the value of the "Other Profession" input field when "Others" is selected
   if ($profession === 'Others' && isset($_POST['profession'])) {
      $otherProfession = $_POST['profession'];
      // Update the profession field with the value of otherProfession
      $profession = $otherProfession;
   } else {
      // Set a default value for profession when "Others" is not selected
      $otherProfession = '';
   }

   // Check if the email address already exists in the database
   $emailCheckSql = "SELECT * FROM wma_forms.j1_visa WHERE email_address = '$email_address'";
   $emailCheckResult = mysqli_query($conn, $emailCheckSql);

   if (mysqli_num_rows($emailCheckResult) > 0) {
      $errors .= "Error: Email address already exists in the database. \n";
   } else {
      // Create a variable with the value 'first_name' . '_' . 'last_name'
      $file_input_value = $email_address;

      // Insert data into the j1_visa table in the wma_forms database
      $insert_sql = "INSERT INTO wma_forms.j1_visa (first_name, last_name, full_address, country, phone_number, email_address, profession, file)
                    VALUES ('$first_name', '$last_name', '$full_address', '$country', '$phone_number', '$email_address', '$profession', '$file_input_value')";

      if (mysqli_query($conn, $insert_sql)) {
         $errors .= "Data inserted successfully. \n";
      } else {
         $errors .= "Error: " . mysqli_error($conn) . "\n";
      }

      // Create a directory for the user if it doesn't exist
      $userDirectory = "../../../Administrator/Applicant_Files/{$email_address}";
      if (!file_exists($userDirectory)) {
         mkdir($userDirectory, 0777, true);
      }

      // Upload and move the resume file to the user's directory
      $resumeFileName = $_FILES['resume']['name'];
      $resumeFilePath = $userDirectory . '/' . $resumeFileName;
      if (move_uploaded_file($_FILES['resume']['tmp_name'], $resumeFilePath)) {
         $errors .= "Resume uploaded successfully. \n";
      } else {
         $errors .= "Error uploading resume. \n";
      }

      // Upload and move the passport file to the user's directory
      $passportFileName = $_FILES['passport']['name'];
      $passportFilePath = $userDirectory . '/' . $passportFileName;
      if (move_uploaded_file($_FILES['passport']['tmp_name'], $passportFilePath)) {
         $errors .= "Passport uploaded successfully. \n";
      } else {
         $errors .= "Error uploading passport. \n";
      }
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <script src="study_and_exchange.js"></script>
   <link rel="stylesheet" href="study_and_exchange.css">
   <title>User Profile</title>
</head>

<body>
   <main>
      <div class="main_left">
         <h2>Submit J1 Visa Application</h2>
         <p>
            <?php echo $errors; ?>
         </p>

         <h1>Welcome,
            <?php echo $userinfo['first_name']; ?>
         </h1>

         <?php if ($credentialType === 'user_token'): ?>
            <img src="<?php echo $userinfo['picture']; ?>" alt="Profile Picture">
         <?php elseif ($credentialType === 'id'): ?>
            <?php if (!empty($_SESSION["profile_picture"])): ?>
               <?php $profile_pic = str_replace('../', '', $_SESSION["profile_picture"]); ?>
               <img src="../../../Users/Standard_User/<?php echo $profile_pic; ?>"
                  alt="../../../Users/Standard_User<?php echo $profile_pic; ?>">
            <?php else: ?>
               <!-- Default profile picture or placeholder image if profile picture is not set -->
               <img src="default_profile_picture.jpg" alt="Default Profile Picture">
            <?php endif; ?>
         <?php endif; ?>
      </div>
      <div class="main_right">
         <form name="myForm" method="post" enctype="multipart/form-data">
            <!-- PERSONAL INFORMATION FIELDSET -->
            <fieldset class="personal_info">
               <h2>1. Personal Information</h2>
               <div class="name_fields">
                  <label class="name">Full Name <b>*</b></label>
                  <div class="name_inputs">
                     <input type="text" id="first_name" name="first_name" placeholder="First Name:"
                        value="<?php echo $userinfo['first_name']; ?>" required>
                     <input type="text" id="last_name" name="last_name" placeholder="Last Name:"
                        value="<?php echo $userinfo['last_name']; ?>" required>
                  </div>
               </div>

               <div class="address_fields">

                  <label class="address">Full Address <b>*</b></label>
                  <div class="address_inputs">
                     <select id="country" name="country" required>
                        <option value="" disabled selected>Select a country</option>
                        <?php
                        foreach ($countries as $countryOption) {
                           echo "<option value=\"$countryOption\">$countryOption</option>";
                        }
                        ?>
                     </select>
                     <input type="text" id="full_address" name="full_address"
                        placeholder="# Street, City, State/Province" required>
                  </div>
               </div>



               <div class="profession_fields">
                  <label for="profession">Profession <b>*</b></label>
                  <div class="profession_inputs">
                     <select id="profession" name="profession" onclick="validate()"
                        onchange="showfield(this.options[this.selectedIndex].value)">
                        <option value="" disabled selected hidden>Choose Profession</option>
                        <option value="Intern">Intern</option>
                        <option value="Teacher">Teacher</option>
                        <option value="Trainee">Trainee</option>
                        <option value="Physician">Physician</option>
                        <option value="Specialist">Specialist</option>
                        <option value="Au Pair/Educare">Au Pair/Educare</option>
                        <option value="Short-term Scholar">Short-term Scholar</option>
                        <option value="Student: College/University">Student: College/University</option>
                        <option value="Professor or Research Scholar">Professor or Research Scholar</option>
                        <option value="Other" id="other">Other</option>
                     </select>
                     <div id="div1" style="display: none;">If Other: <input type="text" name="other_option"
                           id="other_option" onclick="change()" onchange="change()" />
                     </div>
                  </div>
               </div>
            </fieldset>
            <!-- PERSONAL INFORMATION FIELDSET -->

            <!-- CONTACTvINFORMATION FIELDSET -->
            <fieldset class="contact_info">
               <h2>2. Contact Information</h2>
               <div class="contact_fields">
                  <div class="phone_input">
                     <label for="phone_number">Phone Number <b>*</b></label>
                     <input type="tel" id="phone_number" name="phone_number" required>
                  </div>
                  <div class="email_input">
                     <label for="email_address">Email Address <b>*</b></label>
                     <input type="email" id="email_address" name="email_address"
                        value="<?php echo $userinfo['email']; ?>" required>
                  </div>
               </div>
            </fieldset>
            <!-- CONTACT INFORMATION FIELDSET -->

            <!-- FILE UPLOAD FIELDSET -->
            <fieldset class="file_upload">
               <h2>3. Required File Upload</h2>
               <div class="file_fields">
                  <div class="resume_input">
                     <label for="resume">Resume (PDF only) <b>*</b></label>
                     <div class="file_container" id="resume_container">
                        <div>Drag & drop your resume here</div>
                        <input type="file" id="resume" class="file_input_field" name="resume" accept=".pdf" required>
                        <div class="file_name" id="resume_name"></div>
                     </div>
                  </div>
                  <div class="passport_input">
                     <label for="passport">Passport (PDF only) <b>*</b></label>
                     <div class="file_container" id="passport_container">
                        <div>Drag & drop your passport here</div>
                        <input type="file" id="passport" class="file_input_field" name="passport" accept=".pdf" required>
                        <div class="file_name" id="passport_name"></div>
                     </div>
                  </div>
                  <input type="hidden" id="file" name="file" value="<?php echo $file_input_value; ?>">
               </div>
            </fieldset>

            <script>
               const resumeContainer = document.getElementById('resume_container');
               const resumeInput = resumeContainer.querySelector('.file_input_field');
               const resumeFileNameDisplay = resumeContainer.querySelector('.file_name');

               const passportContainer = document.getElementById('passport_container');
               const passportInput = passportContainer.querySelector('.file_input_field');
               const passportFileNameDisplay = passportContainer.querySelector('.file_name');

               resumeContainer.addEventListener('dragover', (e) => {
                  e.preventDefault();
                  resumeContainer.style.border = '2px solid #333'; // Change border color on dragover
               });

               resumeContainer.addEventListener('dragleave', () => {
                  resumeContainer.style.border = '2px dashed #ccc'; // Restore border color on dragleave
               });

               resumeContainer.addEventListener('drop', (e) => {
                  e.preventDefault();
                  resumeContainer.style.border = '2px dashed #ccc'; // Restore border color on drop

                  const files = e.dataTransfer.files;
                  resumeInput.files = files;
                  resumeFileNameDisplay.textContent = files[0].name; // Display file name
                  resumeContainer.classList.add('uploaded'); // Add 'uploaded' class for green glow
               });

               resumeInput.addEventListener('change', () => {
                  resumeFileNameDisplay.textContent = resumeInput.files[0].name; // Display file name
                  resumeContainer.classList.add('uploaded'); // Add 'uploaded' class for green glow
               });

               passportContainer.addEventListener('dragover', (e) => {
                  e.preventDefault();
                  passportContainer.style.border = '2px solid #333'; // Change border color on dragover
               });

               passportContainer.addEventListener('dragleave', () => {
                  passportContainer.style.border = '2px dashed #ccc'; // Restore border color on dragleave
               });

               passportContainer.addEventListener('drop', (e) => {
                  e.preventDefault();
                  passportContainer.style.border = '2px dashed #ccc'; // Restore border color on drop

                  const files = e.dataTransfer.files;
                  passportInput.files = files;
                  passportFileNameDisplay.textContent = files[0].name; // Display file name
                  passportContainer.classList.add('uploaded'); // Add 'uploaded' class for green glow
               });

               passportInput.addEventListener('change', () => {
                  passportFileNameDisplay.textContent = passportInput.files[0].name; // Display file name
                  passportContainer.classList.add('uploaded'); // Add 'uploaded' class for green glow
               });
            </script>
            <!-- FILE UPLOAD FIELDSET -->

            <!-- ELIGIBILTY SECTION FIELDSET -->
            <fieldset class="eligibility_section">
               <h2>4. Program Category Requirements</h2>
               <div class="category_images">
                  <img src="../../../Photos/category.jpg" alt="">
                  <img src="../../../Photos/category2.PNG" alt="">
               </div>
               <div class="eligibility_confirmation">
                  <label for="yes">Yes</label>
                  <input type="radio" name="confirm_eligibility" id="yes">

                  <label for="no">No</label>
                  <input type="radio" name="confirm_eligibility" id="no">
               </div>
            </fieldset>
            <!-- ELIGIBILTY SECTION FIELDSET -->

            <!-- PRIVACY POLICY FIELDSET -->
            <fieldset class="privacy_policy">
            </fieldset>
            <!-- PRIVACY POLICY FIELDSET -->

            <input type="submit" value="Submit Application">
         </form>
      </div>
   </main>
</body>

</html>