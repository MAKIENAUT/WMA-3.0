function toggleExcerpt(contentId) {
   var postCard = document.getElementById('post_card_' + contentId);
   var excerptContainer = document.getElementById('excerptContainer_' + contentId);
   var fullExcerptContainer = document.getElementById('fullExcerptContainer_' + contentId);

   // Save the original height of the postCard
   var originalHeight = postCard.clientHeight;

   excerptContainer.style.display = 'none';
   fullExcerptContainer.style.display = 'block';

   // Set the height to the scrollHeight of the fullExcerptContainer plus the originalHeight
   postCard.style.height = fullExcerptContainer.scrollHeight + originalHeight + "px";
}

function collapseExcerpt(contentId) {
   var postCard = document.getElementById('post_card_' + contentId);
   var excerptContainer = document.getElementById('excerptContainer_' + contentId);
   var fullExcerptContainer = document.getElementById('fullExcerptContainer_' + contentId);

   // Reset height to auto
   postCard.style.height = "fit-content";
   excerptContainer.style.display = 'block';
   fullExcerptContainer.style.display = 'none';
}

function confirmDelete(contentId) {
   // Display a confirmation dialog
   var isConfirmed = confirm("Are you sure you want to delete this content?");

   // If the user confirms, navigate to content_delete.php with the contentId
   if (isConfirmed) {
      window.location.href = 'content_delete.php?contentId=' + contentId;
   }
}