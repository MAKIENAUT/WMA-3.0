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
      <div class="applicant_card" data-search="<?= strtolower("$first_name $last_name $email_address $profession") ?>"
         data-firstname="<?= $first_name ?>" data-lastname="<?= $last_name ?>" data-email="<?= $email_address ?>"
         data-profession="<?= $profession ?>">
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

<style>
   /* Add this CSS code to your HTML file */
   .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.7);
      /* Semi-transparent black background */
   }

   .modal-content {
      background-color: #fefefe;
      margin: 15% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
   }

   .modal-content p {
      color: black;
   }
   .modal-content p b {
      color: black;
   }
   .modal-content p a{
      color: black;
   }

   .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
   }

   .close:hover,
   .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
   }
</style>
<!-- Add a modal to your HTML -->
<div id="myModal" class="modal">
   <div class="modal-content">
      <span class="close">&times;</span>
      <div id="modalContent"></div>
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
         var firstName = this.dataset.firstname;
         var lastName = this.dataset.lastname;
         var email = this.dataset.email;
         var profession = this.dataset.profession;

         var content = `
         <p><b>Name:</b> ${lastName}, ${firstName}</p>
         <p><b>Email:</b> <a href="mailto:${email}">${email}</a></p>
         <p><b>Profession:</b> ${profession}</p>
      `;

         modalContent.innerHTML = content;
         modal.style.display = "block";
      });
   }

   // Get the <span> element that closes the modal
   var span = document.getElementsByClassName("close")[0];

   // When the user clicks on <span> (x), close the modal
   span.onclick = function () {
      modal.style.display = "none";
   }

   // When the user clicks anywhere outside of the modal, close it
   window.onclick = function (event) {
      if (event.target == modal) {
         modal.style.display = "none";
      }
   }
</script>