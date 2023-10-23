<div class="applicant_navigator">
   <h3>Applicants</h3>
   <div class="toolkit">
      <div class="pagination">
         Page:
         <?php
         $page = $_GET['page'] ?? 1;
         $cardsPerPage = 20;
         $start = ($page - 1) * $cardsPerPage;
         $totalCards = count($applicants);
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
   foreach (array_slice($applicants, $start, $cardsPerPage) as $applicant) {
      extract($applicant);
      if ($login_method === "google_login") {
         require_once "../Dashboard_Scripts/wma_users_tables.php";

         foreach ($google_users as $google_user) {
            $profile_picture = $google_user['picture'];
         }
      } else {
         $profile_picture = "../../../Users/Standard_User/Standard_Profile/Profile_Pictures/$email_address/profile_picture.jpg";
      }

      ?>
      <div class="applicant_card" data-id="<?= $id ?>" data-country="<?= $country ?>" data-lastname="<?= $last_name ?>"
         data-email="<?= $email_address ?>" data-firstname="<?= $first_name ?>" data-profession="<?= $profession ?>"
         data-phone_number="<?= $phone_number ?>" data-full_address="<?= $full_address ?>"
         data-date_submitted="<?= $date_submitted ?>" data-profilepicture="<?= $profile_picture ?>"
         data-search="<?= strtolower("$first_name $last_name $email_address $profession") ?>">
         <div class="applicant_picture" style="background-image: url(<?= $profile_picture ?>);">
            <div class="applicant_nameplate">
               <p class="applicant_fullname"><b>
                     <?= $last_name ?>
                  </b>,
                  <?= $first_name ?>
               </p>
               <p class="submit_date">
                  <?= $date_submitted ?>
               </p>
            </div>
         </div>
         <div class="other_details">
            <p>
               <?= $profession ?>
            </p>
         </div>
         <p class="email_address"><a href="">
               <?= $email_address ?>
            </a></p>
      </div>
      <?php
   }
   ?>
</div>

<div id="myModal" class="modal">
   <div class="modal-content">
      <span class="close"><i class="fa-solid fa-xmark"></i></span>
      <div id="modalContent" class="applicant_picture"></div>
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

   // Loop through the cards and add a click event listener to each
   for (var i = 0; i < cards.length; i++) {
      cards[i].addEventListener('click', function () {

         var id = this.dataset.id;
         var email = this.dataset.email;
         var country = this.dataset.country;
         var lastName = this.dataset.lastname;
         var firstName = this.dataset.firstname;
         var profession = this.dataset.profession;
         var fullAddress = this.dataset.full_address;
         var phoneNumber = this.dataset.phone_number;
         var dateSubmitted = this.dataset.date_submitted;
         var profilePicture = this.dataset.profilepicture; // Add this line

         var content = `
            <div class="applicant_picture" style="background-image: url(${profilePicture});">
               <p id="modal_id">${id}</p>
               <div class="applicant_nameplate">
                  <p style="color: white;"><b style="color: white;">Name:</b> ${lastName}, ${firstName}</p>
                  <p style="color: white;"><b style="color: white;">Date Submitted: </b> ${dateSubmitted}</p>
                  <p style="color: white;"><b style="color: white;">Phone No.: </b> ${phoneNumber}</p>
               </div>
            </div>
            <p><b>Email:</b> <a href="mailto:${email}">${email}</a></p>
            <p><b>Profession:</b> ${profession}</p>
            <p><b>Address: </b>${country}, ${fullAddress}</p>
         `;

         modalContent.innerHTML = content;
         modal.style.display = "flex";
      });
   }

   // Get the <span> element that closes the modal
   var span = document.getElementsByClassName("close")[0];
   // When the user clicks anywhere outside of the modal, close it
   window.onclick = function (event) {
      if (event.target == modal) {
         modal.style.display = "none";
      }
   }
   // When the user clicks on <span> (x), close the modal
   span.onclick = function () {
      modal.style.display = "none";
   }
</script>