<?php
require_once "../../Admin_Global/page_initiators.php";
require_once "../../Admin_Global/fetch_applicants.php";
?>

<div class="applicant_navigator">
   <h3>Employers </h3>
   <div class="toolkit">
      <div class="pagination">
         Page:
         <?php
         $page = $_GET['page'] ?? 1;
         $cardsPerPage = 20;
         $start = ($page - 1) * $cardsPerPage;
         $totalCards = count($employers);
         $totalPages = ceil($totalCards / $cardsPerPage);

         if ($page > 1)
            echo "<a href='?page=" . ($page - 1) . "'>Previous</a>";

         for ($i = 1; $i <= $totalPages; $i++) {
            $activeClass = ($i == $page) ? 'active' : '';
            echo "<a href='?page=$i' class='$activeClass'>$i</a>";
         }

         if ($page < $totalPages)
            echo "<a href='?page=" . ($page + 1) . "'>Next</a>";
         ?>
      </div>

      <div class="search_bar">
         <input type="text" id="searchbar" name="searchbar" placeholder="🔎 Search" oninput="applicant_search()">
      </div>
   </div>
</div>

<div class="applicant_card_container">
   <?php
   if (empty($employers)) {
      echo "<p>No employers found.</p>";
   } else {
      foreach (array_slice($employers, $start, $cardsPerPage) as $employer) {
         extract($employer);
         if ($login_method === "google_login") {
            require_once '../../Admin_Database/wma_users.php';

            $query_google = "SELECT * FROM wma_users_google WHERE email = '$email_address'";
            $result_google = $conn->query($query_google);

            $google_users = [];

            if ($result_google) {
               while ($row = $result_google->fetch_assoc()) {
                  $google_users[] = $row;
               }

               $result_google->free();
            } else {
               echo "Error: " . $conn->error;
            }

            foreach ($google_users as $google_user) {
               $user_type = ucfirst($google_user['user_type']);
               $profile_picture = $google_user['picture'];
            }
         } else {
            $profile_picture = "../../../Users/Standard_User/Standard_Profile/Profile_Pictures/$email_address/profile_picture.jpg";
         }

   ?>
         <div class="employer_card" data-id="<?= $id ?>" data-city="<?= $city ?>" data-state="<?= $state ?>" data-country="<?= $country ?>" data-lastname="<?= $last_name ?>" data-user_type="<?= $user_type ?>" data-email="<?= $email_address ?>" data-firstname="<?= $first_name ?>" data-created_at="<?= $created_at ?>" data-time_frame="<?= $time_frame ?>" data-school="<?= $school_district ?>" data-full_address="<?= $full_address ?>" data-phone_number="<?= $phone_number ?>" data-teacher_category="<?= $teacher_category ?>" data-teacher_estimate="<?= $teacher_estimate ?>" data-reference_source="<?= $reference_source ?>" data-profilepicture="<?= $profile_picture ?>" data-search="<?= strtolower("$first_name $last_name $email_address $school_district") ?>">
            <div class="applicant_picture" style="background-image: url(<?= $profile_picture ?>);">
               <div class="applicant_nameplate">
                  <p class="applicant_fullname"><b>
                        <?= $last_name ?>
                     </b>,
                     <?= $first_name ?>,
                     <?= $middle_name ?>
                  </p>
                  <p class="submit_date">
                     <?= $created_at ?>
                  </p>
               </div>
            </div>
            <div class="other_details">
               <p>
                  <?= $user_type ?>
               </p>
            </div>
            <p class="email_address"><a href="">
                  <?= $email_address ?>
               </a></p>
         </div>
   <?php
      }
   }
   ?>
</div>

<div id="myModal" class="modal">
   <div class="modal-content">
      <span class="close"><i class="fa-solid fa-xmark"></i></span>
      <div id="modalContent" class="applicant_picture">
      </div>
   </div>
</div>

<!-- Add this JavaScript code to your HTML file -->
<script>
   // Get the modal
   var modal = document.getElementById("myModal");

   // Get the content element in the modal
   var modalContent = document.getElementById("modalContent");

   // Get all elements with class "applicant_card"
   var cards = document.getElementsByClassName("applicant_card");

   // Function to confirm delete
   function confirmDelete(email) {
      var confirmDelete = confirm("Are you sure you want to delete this applicant?");
      if (confirmDelete) {
         window.location.href = '../Dash_Global/applicant_delete.php?email=' + encodeURIComponent(email);
      }
   }

   // Loop through the cards and add a click event listener to each
   for (var i = 0; i < cards.length; i++) {
      cards[i].addEventListener('click', function() {
         var id = this.dataset.id
         var city = this.dataset.city
         var email = this.dataset.email
         var state = this.dataset.state
         var school = this.dataset.school
         var country = this.dataset.country
         var lastname = this.dataset.lastname
         var user_type = this.dataset.user_type
         var firstname = this.dataset.firstname
         var created_at = this.dataset.created_at
         var time_frame = this.dataset.time_frame
         var full_address = this.dataset.full_address
         var phone_number = this.dataset.phone_number
         var teacher_category = this.dataset.teacher_category
         var teacher_estimate = this.dataset.teacher_estimate
         var reference_source = this.dataset.reference_source
         var profilepicture = this.dataset.profilepicture

         var content = `
            <div class="applicant_picture" style="background-image: url(${profilepicture});">
               <p id="modal_id">${id}</p>
               <div class="applicant_actions">
                  <a href="../Applicants/file_manager.php?email=${email}" class="file_manager">
                     <i class="fa-regular fa-folder-open"></i>
                  </a>
                  <a href="#" class="applicant_delete" onclick="confirmDelete('${email}')">
                     <i class="fa-solid fa-trash"></i>
                  </a>
               </div>
               <div class="applicant_nameplate">
                  <p style="color: white;"><b style="color: white;">Name:</b> ${lastname}, ${firstname}</p>
                  <p style="color: white;"><b style="color: white;">Date Submitted: </b> ${created_at}</p>
                  <p style="color: white;"><b style="color: white;">Phone No.: </b> ${phone_number}</p>
               </div>
            </div>
            <p><b>Reference:</b> ${reference_source}</p>
            <p><b>Email:</b> <a href="mailto:${email}">${email}</a></p>
            <p><b>Address: </b>${country}, ${full_address}</p>
         `;

         modalContent.innerHTML = content;
         modal.style.display = "flex";
      });
   }


   // Get the <span> element that closes the modal
   var span = document.getElementsByClassName("close")[0];
   // When the user clicks anywhere outside of the modal, close it
   window.onclick = function(event) {
      if (event.target == modal) {
         modal.style.display = "none";
      }
   }
   // When the user clicks on <span> (x), close the modal
   span.onclick = function() {
      modal.style.display = "none";
   }
</script>