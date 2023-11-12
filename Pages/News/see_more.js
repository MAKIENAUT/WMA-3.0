const navLinkContainer = document.getElementById('navbarLinkContainer');
const navMobileIcon = document.getElementById('navbarMobileIcon');

function toggleNavbar() {
   navLinkContainer.classList.toggle('active');
}

document.addEventListener('click', function (event) {
   if (
      !navLinkContainer.contains(event.target) &&
      event.target !== navMobileIcon
   ) {
      navLinkContainer.classList.remove('active');
   }
});

function toggleSocialIcons(contentId) {
   var socialIcons = document.getElementById('socialIcons_' + contentId);
   socialIcons.style.display = (socialIcons.style.display === 'none' || socialIcons.style.display === '') ? 'flex' : 'none';
}

function incrementShareCount(contentId) {
   // Toggle social icons
   toggleSocialIcons(contentId);

   // Increment share_count via AJAX
   $.ajax({
      type: 'POST',
      url: 'update_share_count.php',
      data: {
         contentId: contentId
      },
      success: function (response) {
         console.log(response);

         // Parse the response to get the updated share_count
         var updatedShareCount = parseInt(response.trim());

         // Update total share count span
         var totalShareCountSpan = $('#totalShareCount_' + contentId);
         totalShareCountSpan.text('Total Share Count: ' + updatedShareCount);

         // Reset the position of the paper plane button
         $('#socialIcons_' + contentId).hide();
      },
      error: function (error) {
         console.error(error);
      }
   });
}
