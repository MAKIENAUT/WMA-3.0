<?php
require_once "../../../Administrator/Admin_Database/wma_users.php";
session_start();

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
   header("Location: ../../../Users/Standard_User/Standard_Login/user_login.php");
   die();
}

if (isset($_SESSION['user_token'])) {
   $credentialType = 'google_login';
   $sql = $conn->prepare("SELECT * FROM wma_users_google WHERE token = ?");
   $sql->bind_param("s", $_SESSION['user_token']);
   $sql->execute();
   $result = $sql->get_result();
} elseif (isset($_SESSION['id'])) {
   $credentialType = 'standard_login';
   $sql = $conn->prepare("SELECT * FROM wma_users_standard WHERE id = ?");
   $sql->bind_param("i", $_SESSION['id']);
   $sql->execute();
   $result = $sql->get_result();
}

if ($result->num_rows > 0) {
   $userinfo = $result->fetch_assoc();
} else {
   $errors .= "User not found in the database.\n";
   die();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $first_name = htmlspecialchars($_POST['first_name'], ENT_QUOTES, 'UTF-8');
   $last_name = htmlspecialchars($_POST['last_name'], ENT_QUOTES, 'UTF-8');
   $full_address = htmlspecialchars($_POST['full_address'], ENT_QUOTES, 'UTF-8');
   $country = $_POST['country'];
   $phone_number = htmlspecialchars($_POST['phone_number'], ENT_QUOTES, 'UTF-8');
   $email_address = filter_var($_POST['email_address'], FILTER_SANITIZE_EMAIL);
   $profession = htmlspecialchars($_POST['profession'], ENT_QUOTES, 'UTF-8');
   $login_method = $credentialType;

   if ($profession === 'Others' && isset($_POST['profession'])) {
      $otherProfession = htmlspecialchars($_POST['profession'], ENT_QUOTES, 'UTF-8');
      $profession = $otherProfession;
   } else {
      $otherProfession = '';
   }

   $emailCheckSql = $conn->prepare("SELECT * FROM wma_forms.j1_visa WHERE email_address = ?");
   $emailCheckSql->bind_param("s", $email_address);
   $emailCheckSql->execute();
   $emailCheckResult = $emailCheckSql->get_result();

   if ($emailCheckResult->num_rows > 0) {
      $errors .= "Error: Email address already exists in the database.\n";
   } else {
      $file_input_value = $email_address;

      $insert_sql = $conn->prepare("INSERT INTO wma_forms.j1_visa (first_name, last_name, full_address, country, phone_number, email_address, profession, file, login_method) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $insert_sql->bind_param("sssssssss", $first_name, $last_name, $full_address, $country, $phone_number, $email_address, $profession, $file_input_value, $login_method);


      if ($insert_sql->execute()) {
         $errors .= "Data inserted successfully.\n";
      } else {
         $errors .= "Error: " . $conn->error . "\n";
      }
   
      $userDirectory = "../../../Administrator/Applicant_Files/{$email_address}";
      if (!file_exists($userDirectory)) {
         mkdir($userDirectory, 0777, true);
      }

      // Upload and move the resume file to the user's directory
      $resumeFileName = $_FILES['resume']['name'];
      $resumeFileExtension = pathinfo($resumeFileName, PATHINFO_EXTENSION);
      $resumeFileName = $last_name . "_Resume.pdf"; // Construct the new file name

      $resumeFilePath = $userDirectory . '/' . $resumeFileName;

      if (move_uploaded_file($_FILES['resume']['tmp_name'], $resumeFilePath)) {
         $errors .= "Resume uploaded successfully. \n";
      } else {
         $errors .= "Error uploading resume. \n";
      }

      // Upload and move the passport file to the user's directory
      $passportFileName = $_FILES['passport']['name'];
      $passportFileExtension = pathinfo($passportFileName, PATHINFO_EXTENSION);
      $passportFileName = $last_name . "_Passport.pdf"; // Construct the new file name

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
   <!-- FontAwesome -->
   <link rel="stylesheet" crossorigin="anonymous" referrerpolicy="no-referrer"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
      integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" />
   <!-- FontAwesome -->
   <link rel="stylesheet" href="/Pages/Global/global.css" />
   <link rel="icon" type="image/x-icon" href="/Photos/WMA.png">
   <script defer src="/Pages/Global/global.js"></script>
   <script defer src="study_and_exchange.js"></script>
   <link rel="stylesheet" href="study_and_exchange.css">
   <title>User Profile</title>
</head>

<body>
   <!-- NAV SECTION -->
   <?php require_once "navbar.php" ?>

   <main>
      <div class="main_left">
         <h2>Submit J1 Visa Application</h2>
         <p>
            <?php echo $errors; ?>
         </p>

         <h1>Welcome,
            <?php echo $userinfo['first_name']; ?>
         </h1>

         <?php if ($credentialType === 'google_login'): ?>
            <img src="<?php echo $userinfo['picture']; ?>" alt="Profile Picture">
         <?php elseif ($credentialType === 'standard_login'): ?>
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
                        onchange="showfield(this.options[this.selectedIndex].value)" required>
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

            <!-- CONTACT INFORMATION FIELDSET -->
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

            <!-- FILE UPLOAD FIELDSET -->
            <fieldset class="file_upload">
               <h2>3. Required File Upload</h2>
               <div class="file_fields">
                  <div class="resume_input">
                     <label for="resume">Resume (PDF only) <b>*</b></label>
                     <div class="file_container" id="resume_container">
                        <div>Click/drag & drop your resume here</div>
                        <input type="file" id="resume" class="file_input_field" name="resume" accept=".pdf" required>
                        <div class="file_name" id="resume_name"></div>
                     </div>
                  </div>
                  <div class="passport_input">
                     <label for="passport">Passport (PDF only) <b>*</b></label>
                     <div class="file_container" id="passport_container">
                        <div>click/drag & drop your passport here</div>
                        <input type="file" id="passport" class="file_input_field" name="passport" accept=".pdf"
                           required>
                        <div class="file_name" id="passport_name"></div>
                     </div>
                  </div>
                  <input type="hidden" id="file" name="file" value="<?php echo $file_input_value; ?>">
               </div>
            </fieldset>

            <script src="file_upload.js"></script>

            <!-- ELIGIBILTY SECTION FIELDSET -->
            <fieldset class="eligibility_section">
               <h2>4. Program Category Requirements</h2>
               <div class="category_images">
                  <img src="../../../Photos/category.jpg" alt="" class="zoomable">
               </div>
               <div class="category_images">
                  <img src="../../../Photos/category2.PNG" alt="" class="zoomable">
               </div>
               <div class="eligibility_confirmation">
                  <label class="confirm_eligibility">
                     Do you meet the eligibility requirement for the specific program? <b>*</b>
                  </label>
                  <div class="eligibility_fields">
                     <div class="yes_button">
                        <input type="radio" name="confirm_eligibility" id="yes">
                        <label for="yes">Yes</label>
                     </div>
                     <div class="no_button">

                        <input type="radio" name="confirm_eligibility" id="no">
                        <label for="no">No</label>
                     </div>
                  </div>
               </div>
            </fieldset>

            <!-- PRIVACY POLICY FIELDSET -->
            <fieldset class="privacy_policy">
               <h2>5. Privacy Policy</h2>

               <p>
                  Read the Privacy Policy and give permission for West Migration Agency LLC to share my information and
                  discuss my candidacy with any US Sponsors as part of the visa process.
               </p>


               <a href="">Click & Read!</a>

               <div class="terms_and_conditions">
                  <label for="terms_and_condition">Terms and Conditions</label>
                  <input type="checkbox" name="terms_and_condition" id="terms_and_condition" required>
               </div>

            </fieldset>

            <input type="submit" value="Submit Application">
         </form>
      </div>
   </main>

   <!-- FOOTER SECTION -->
   <?php require_once "footer.php" ?>
</body>

</html>