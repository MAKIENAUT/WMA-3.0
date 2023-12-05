
document.addEventListener('click', function (event) {
   if (
      !navLinkContainer.contains(event.target) &&
      event.target !== navMobileIcon
   ) {
      navLinkContainer.classList.remove('active');
   }
});

function filter_content(category) {
   const postCards = document.querySelectorAll('.post_card');

   postCards.forEach(card => {
      const cardCategory = card.getAttribute('data-category');
      if (category === 'all' || category === cardCategory) {
         card.classList.add('active');
      } else {
         card.classList.remove('active');
      }
   });
}



function toggleSocialIcons(contentId) {
   var socialIcons = document.getElementById('socialIcons_' + contentId);

   if (socialIcons.style.display === 'none') {
      socialIcons.style.display = 'flex';
   } else {
      socialIcons.style.display = 'none';
   }
   console.log(socialIcons.style.display);
   console.log(contentId);
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
         totalShareCountSpan.text(updatedShareCount);

         // Reset the position of the paper plane button
         $('#socialIcons_' + contentId).hide();
      },
      error: function (error) {
         console.error(error);
      }
   });
}
