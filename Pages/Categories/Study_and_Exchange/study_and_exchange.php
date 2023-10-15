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
   header("Location: ../../../Users/Standard_User/Standard_Login/user_login.php");
   die();
}

if (isset($_SESSION['user_token'])) {
   $credentialType = 'user_token';
   $sql = $conn->prepare("SELECT * FROM wma_users_google WHERE token = ?");
   $sql->bind_param("s", $_SESSION['user_token']);
   $sql->execute();
   $result = $sql->get_result();
} elseif (isset($_SESSION['id'])) {
   $credentialType = 'id';
   $sql = $conn->prepare("SELECT * FROM wma_users_standard WHERE id = ?");
   $sql->bind_param("i", $_SESSION['id']);
   $sql->execute();
   $result = $sql->get_result();
}

if ($result->num_rows > 0) {
   $userinfo = $result->fetch_assoc();
} else {
   $errors .= "User not found in the database. \n";
   die();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   // Sanitize and validate input
   $first_name = htmlspecialchars($_POST['first_name'], ENT_QUOTES, 'UTF-8');
   $last_name = htmlspecialchars($_POST['last_name'], ENT_QUOTES, 'UTF-8');
   $full_address = htmlspecialchars($_POST['full_address'], ENT_QUOTES, 'UTF-8');
   $country = $_POST['country']; // The selected country
   $phone_number = htmlspecialchars($_POST['phone_number'], ENT_QUOTES, 'UTF-8');
   $email_address = filter_var($_POST['email_address'], FILTER_SANITIZE_EMAIL);
   $profession = htmlspecialchars($_POST['profession'], ENT_QUOTES, 'UTF-8');

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
   <nav class="navbar-parent">
      <div class="navbar-container">
         <div class="navbar-main-container">
            <a class="navbar-logo" href="#">
               <img src="/Photos/wma-logo.png" alt="WMA Logo" />
            </a>
            <button id="navbarMobileIcon" class="navbar-mobile-icon fa fa-bars burger-icon" onclick="toggleNavbar()">
            </button>
         </div>
         <div id="navbarLinkContainer" class="navbar-link-container">
            <a class="navbar-link" href="#">News</a>
            <div class="navbar-category-container" href="javascript:void(0)">
               <p id="navbarCategoryContainer" onclick="toggleCategory()">Process<i class="fa-solid fa-caret-down"></i>
               </p>
               <div id="navbarCategory" class="navbar-category">
                  <a class="navbar-category-link" href="#">Family Based</a>
                  <a class="navbar-category-link" href="../Categories/Study_and_Exchange/study_and_exchange.php">Study
                     and Exchange</a>
                  <a class="navbar-category-link" href="#">Temporary Employment</a>
               </div>
            </div>
            <div class="navbar-category-container" href="javascript:void(0)">
               <p id="navbarCategoryContainer2" onclick="toggleCategory2()">Categories<i
                     class="fa-solid fa-caret-down"></i></p>
               <div id="navbarCategory2" class="navbar-category">
                  <a class="navbar-category-link" href="#">Family Based</a>
                  <a class="navbar-category-link" href="#">Study and Exchange (J-1)</a>
                  <a class="navbar-category-link" href="#">Temporary Employment (EB-3/H2A)</a>
               </div>
            </div>
            <a class="navbar-link" href="#">About Us</a>
            <a class="navbar-link" href="#">Login/Sign up</a>
         </div>
      </div>
   </nav>

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
   <footer class="footer-parent">
      <section class="footer-content">
         <section class="footer-main-content">
            <section class="footer-disclaimer">
               <div class="disclaimer-content">
                  <img src="/Photos/wma-logo.png" alt="WMA logo">
                  <p>West Migration Agency LLC (“WMA”) is the parent company of West Migration Consultancy Inc.,(“WMC”)
                     based
                     in
                     the Philippines. WMC and its state affiliates advance the corporation's interest to engage in
                     immigration
                     consultancy by providing expert advice to prospective clients for the USA through qualification
                     assistance,
                     processing of applications, and other related documents. </p>
               </div>
               <div class="misc-photos">
                  <img src="/Photos/wmc-logo.png" alt="WMC logo">
                  <img src="/Photos/USCIS.svg" alt="USCIS logo">
               </div>
            </section>
            <section class="footer-info">
               <section class="footer-contact">
                  <h1>Contact us</h1>
                  <div class="contact-content">
                     <div class="contact-address">
                        <header><i class="fa-solid fa-location-dot"></i> Address:</header>
                        <div>3400 Cottage Way STE. G2 #11495 Sacramento, CA 95825</div>
                     </div>
                     <div class="contact-email">
                        <header><i class="fa-solid fa-envelope"></i> Email:</header>
                        <div>admin@westmigrationagency.us</div>
                     </div>
                     <div class="contact-number">
                        <header><i class="fa-solid fa-phone"></i> Phone:</header>
                        <div>415-633-6865</div>
                     </div>
                  </div>
               </section>
               <section class="footer-ph-office">
                  <h1>PH Office</h1>
                  <div class="contact-content">
                     <div class="contact-address">
                        <header><i class="fa-solid fa-location-dot"></i> Address (Cebu Branch):</header>
                        <div>11th Floor, AppleOne - Equicom Tower Mindanao Avenue, cor. Biliran St., Cebu Business Park,
                           Cebu
                           City 6000 Philippines</div>
                     </div>
                     <div class="contact-address">
                        <header><i class="fa-solid fa-location-dot"></i> Address (Dagupan Branch):</header>
                        <div>Upcoming!</div>
                     </div>
                  </div>
               </section>
            </section>
         </section>
         <section class="footer-more-info">
            <section class="about-us">
               <h1>About Us</h1>
               <div class="footer-more-info-content">
                  <a href="#">About us</a>
                  <a href="#">Specialization</a>
               </div>
            </section>
            <section class="footer-process">
               <h1>Process</h1>
               <div class="footer-more-info-content">
                  <a href="#">Family Based</a>
                  <a href="#">Study and Exchange</a>
                  <a href="#">Temporary Employment</a>
               </div>
            </section>
            <section class="footer-links">
               <h1>More Info</h1>
               <div class="footer-more-info-content">
                  <a href="#">News</a>
                  <a href="#">Contact us</a>
                  <a href="#">Administrator</a>
               </div>
            </section>
            <section class="footer-socials">
               <h1>Our Social Links</h1>
               <div class="social-content">
                  <a href="#" class="fa-brands fa-facebook"></a>
                  <a href="#" class="fa-brands fa-instagram"></a>
               </div>
            </section>
         </section>
      </section>
      <section class="copyright">
         <p>Copyright 2023</p>
      </section>
   </footer>
</body>

</html>