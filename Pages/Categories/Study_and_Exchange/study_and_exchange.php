<?php
require_once '../../../Users/User_Login_Google/config.php';


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
   echo "User not found in the database.";
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
   $date_submitted = $_POST['date_submitted'];

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
      echo "Error: Email address already exists in the database.";
   } else {
      // Create a variable with the value 'first_name' . '_' . 'last_name'
      $file_input_value = $first_name . '_' . $last_name;

      // Insert data into the j1_visa table in the wma_forms database
      $insert_sql = "INSERT INTO wma_forms.j1_visa (first_name, last_name, full_address, country, phone_number, email_address, profession, date_submitted, file)
                    VALUES ('$first_name', '$last_name', '$full_address', '$country', '$phone_number', '$email_address', '$profession', '$date_submitted', '$file_input_value')";

      if (mysqli_query($conn, $insert_sql)) {
         echo "Data inserted successfully.";
      } else {
         echo "Error: " . mysqli_error($conn);
      }

      // Create a directory for the user if it doesn't exist
      $userDirectory = "../../../Administrator/Applicant_Files/{$first_name}_{$last_name}";
      if (!file_exists($userDirectory)) {
         mkdir($userDirectory, 0777, true);
      }

      // Upload and move the resume file to the user's directory
      $resumeFileName = $_FILES['resume']['name'];
      $resumeFilePath = $userDirectory . '/' . $resumeFileName;
      if (move_uploaded_file($_FILES['resume']['tmp_name'], $resumeFilePath)) {
         echo "Resume uploaded successfully.";
      } else {
         echo "Error uploading resume.";
      }

      // Upload and move the passport file to the user's directory
      $passportFileName = $_FILES['passport']['name'];
      $passportFilePath = $userDirectory . '/' . $passportFileName;
      if (move_uploaded_file($_FILES['passport']['tmp_name'], $passportFilePath)) {
         echo "Passport uploaded successfully.";
      } else {
         echo "Error uploading passport.";
      }
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>User Profile</title>
</head>

<body>
   <h1>Welcome,
      <?php echo $userinfo['first_name']; ?>
   </h1>

   <!-- Display the profile picture -->
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

   <p>Email:
      <?php echo $userinfo['email']; ?>
   </p>

   <p>Credential Type:
      <?php echo $credentialType; ?>
   </p>

   <a href="../../../Users/Standard_User/Standard_Logout/logout.php">logout</a>

   <!-- Add the form for user input -->
   <h2>Submit J1 Visa Application</h2>
   <form action="" method="post" enctype="multipart/form-data">
      <label for="first_name">First Name:</label>
      <input type="text" id="first_name" name="first_name" required><br>

      <label for="last_name">Last Name:</label>
      <input type="text" id="last_name" name="last_name" required><br>

      <label for="full_address">Full Address:</label>
      <input type="text" id="full_address" name="full_address" required><br>

      <!-- Replace the country input with a select field -->
      <label for="country">Country:</label>
      <select id="country" name="country" required>
         <option value="" disabled selected>Select a country</option>
         <?php
         foreach ($countries as $countryOption) {
            echo "<option value=\"$countryOption\">$countryOption</option>";
         }
         ?>
      </select><br>

      <label for="phone_number">Phone Number:</label>
      <input type="tel" id="phone_number" name="phone_number" required><br>

      <label for="email_address">Email Address:</label>
      <input type="email" id="email_address" name="email_address" required><br>

      <label for="profession">Profession:</label>
      <select id="profession" name="profession" required>
         <option value="">Select a profession</option>
         <option value="Intern">Intern</option>
         <option value="Teacher">Teacher</option>
         <option value="Trainee">Trainee</option>
         <option value="Physician">Physician</option>
         <option value="Specialist">Specialist</option>
         <option value="AuPair/Educare">AuPair/Educare</option>
         <option value="Short-Term Scholar">Short-Term Scholar</option>
         <option value="Student: College/University">Student: College/University</option>
         <option value="Professor or Research Scholar">Professor or Research Scholar</option>
         <option value="Others">Others</option>
      </select><br>

      <!-- Hidden input for Others -->
      <div id="otherProfessionInput" style="display: none;">
         <label for="otherProfession">Other Profession:</label>
         <input type="text" id="otherProfession" name="otherProfession">
      </div>

      <!-- JavaScript to handle the conditional appearance of the text input field -->
      <!-- JavaScript to handle the conditional appearance of the text input field -->
      <script>
         document.getElementById('profession').addEventListener('change', function () {
            var otherProfessionInput = document.getElementById('otherProfessionInput');
            var selectedProfession = this.value;

            if (selectedProfession === 'Others') {
               otherProfessionInput.style.display = 'block';
               // Make the "Other Profession" field required when selected
               document.getElementById('otherProfession').required = true;
            } else {
               otherProfessionInput.style.display = 'none';
               // Make the "Other Profession" field not required when not selected
               document.getElementById('otherProfession').required = false;
            }
         });
      </script>


      <label for="date_submitted">Date Submitted:</label>
      <input type="date" id="date_submitted" name="date_submitted" required><br>

      <label for="resume">Resume (PDF only):</label>
      <input type="file" id="resume" name="resume" accept=".pdf" required><br>

      <label for="passport">Passport (PDF only):</label>
      <input type="file" id="passport" name="passport" accept=".pdf" required><br>

      <input type="hidden" id="file" name="file" value="<?php echo $file_input_value; ?>">

      <input type="submit" value="Submit Application">
   </form>
</body>

</html>