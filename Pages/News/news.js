
function toggleExcerpt(contentId) {
   var excerptContainer = $('#excerptContainer_' + contentId);
   var fullExcerptContainer = $('#fullExcerptContainer_' + contentId);

   excerptContainer.hide();
   fullExcerptContainer.show();
}

function collapseExcerpt(contentId) {
   var excerptContainer = $('#excerptContainer_' + contentId);
   var fullExcerptContainer = $('#fullExcerptContainer_' + contentId);

   excerptContainer.show();
   fullExcerptContainer.hide();
}

$(document).ready(function () {
   $('.like-button').on('click', function () {
      var likeButton = $(this);
      var action = likeButton.data('action');
      var content_id = likeButton.data('content-id');

      $.ajax({
         type: 'POST',
         url: 'ajax_like.php',
         data: { action: action, content_id: content_id },
         success: function (data) {
            var likeCountElement = likeButton.closest('.interaction_info').find('.like-count');
            var currentLikeCount = parseInt(likeCountElement.text());

            if (action == 'like') {
               likeButton.find('i').removeClass('fa-regular').addClass('fa-solid').css('color', 'red');
               likeButton.data('action', 'unlike');
               likeCountElement.text(currentLikeCount + 1);
            } else {
               likeButton.find('i').removeClass('fa-solid').addClass('fa-regular').css('color', '');
               likeButton.data('action', 'like');
               likeCountElement.text(Math.max(0, currentLikeCount - 1));
            }
         }
      });
   });
});


